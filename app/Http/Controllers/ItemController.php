<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Items;
use App\Models\Kategori;

class ItemController extends Controller
{
    public function index()
    {
        $items = Items::with('kategori')
            ->latest()
            ->get();

        return view('items.index', compact('items'));
    }
    
    public function create()
    {
        $kategori = Kategori::all();
        return view('cari', compact('kategori'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255',
            'no_telp'       => 'required|string|max:255',
            'nama_barang'   => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'tanggal'       => 'required|date',
            'deskripsi'     => 'required|string',
            'tipe_laporan' => 'required|in:Kehilangan Barang,Kehilangan Pemilik',
            'foto_barang'   => 'nullable|image|mimetypes:image/jpeg,image/png|max:5048',
        ],
        [
            'foto_barang.mimetypes' => 'File harus berupa gambar (JPG, PNG). File PDF atau format lain tidak diperbolehkan.',
            'foto_barang.image' => 'File harus berupa gambar yang valid.',
            'foto_barang.max' => 'Ukuran file tidak boleh lebih dari 5MB.',
        ]);

        if ($validator->fails()) {
            if (!$request->wantsJson()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload foto jika ada
        $pathFoto = null;
        if ($request->hasFile('foto_barang')) {
            $file = $request->file('foto_barang');
            $filePath = $file->getRealPath();
            $originalName = $file->getClientOriginalName();
            
            // Validasi 1: Check Extension
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower($file->getClientOriginalExtension());
            
            if (!in_array($fileExtension, $allowedExtensions)) {
                $errorMsg = 'File harus berupa gambar JPG atau PNG. Extension .' . $fileExtension . ' tidak diperbolehkan.';
                
                if (!$request->wantsJson()) {
                    return redirect()->back()
                        ->withErrors(['foto_barang' => $errorMsg])
                        ->withInput();
                }
                
                return response()->json([
                    'status' => 'error',
                    'errors' => ['foto_barang' => [$errorMsg]]
                ], 422);
            }
            
            // Validasi 2: Check Magic Bytes (File Signature)
            $handle = fopen($filePath, 'r');
            $fileHeader = fread($handle, 12);
            fclose($handle);
            
            $validSignatures = [
                'FF D8 FF',      // JPEG
                '89 50 4E 47',   // PNG
            ];
            
            $hexHeader = bin2hex($fileHeader);
            $isValidSignature = false;
            
            foreach ($validSignatures as $sig) {
                $sigHex = str_replace(' ', '', $sig);
                if (strpos(strtoupper($hexHeader), $sigHex) === 0) {
                    $isValidSignature = true;
                    break;
                }
            }
            
            if (!$isValidSignature) {
                $errorMsg = 'File tidak valid. Hanya gambar JPG dan PNG yang diperbolehkan. File PDF atau file yang di-rename tidak diterima.';
                
                if (!$request->wantsJson()) {
                    return redirect()->back()
                        ->withErrors(['foto_barang' => $errorMsg])
                        ->withInput();
                }
                
                return response()->json([
                    'status' => 'error',
                    'errors' => ['foto_barang' => [$errorMsg]]
                ], 422);
            }
            
            // Validasi 3: Check MIME type sebagai layer tambahan
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $filePath);
            finfo_close($finfo);
            
            if (!in_array($mimeType, ['image/jpeg', 'image/png'])) {
                $errorMsg = 'Tipe file tidak valid. MIME type: ' . $mimeType;
                
                if (!$request->wantsJson()) {
                    return redirect()->back()
                        ->withErrors(['foto_barang' => $errorMsg])
                        ->withInput();
                }
                
                return response()->json([
                    'status' => 'error',
                    'errors' => ['foto_barang' => [$errorMsg]]
                ], 422);
            }
            
            $pathFoto = $file->store('barang_hilang', 'public');
        }

        // Simpan ke database
        $item = Items::create([
            'nama'          => $request->nama,
            'no_telp'       => $request->no_telp,
            'nama_barang'   => $request->nama_barang,
            'foto_barang'   => $pathFoto,
            'lokasi'        => $request->lokasi,
            'tanggal'       => $request->tanggal,
            'id_kategori'   => $request->id_kategori,
            'deskripsi'     => $request->deskripsi,
            'tipe_laporan'  => $request->tipe_laporan,
            'status_barang' => 'Belum Ditemukan', // default eksplisit
        ]);

        // Response JSON (AJAX / API)
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Data berhasil masuk database!',
                'data'    => $item
            ], 201);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ], 201);}

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function getAll()
    {
        $getAll = Items::with('kategori')->latest()->paginate(12);
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('semuaBarang', compact('getAll', 'kategoris'));
    }
    
    public function show($id)
    {
        // Ambil data item berdasarkan ID
        $item = Items::findOrFail($id);
        $relatedItems = Items::where('id', '!=', $item->id)
            ->where('id_kategori', $item->id_kategori) // atau id_kategori
            ->latest()
            ->take(4)
            ->get();

        // Kirim ke view
        return view('detailBarang', compact('item', 'relatedItems'));
    }
}
