<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view with posts
        return view('posts.index', compact('posts'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nim'     => 'required|min:5',
            'nama'   => 'required|min:5',
            'alamat'   => 'required|min:5',
            'nomorhp'   => 'required|min:5',
            'motivasikuliah'   => 'required|min:10'
        ]);

        //create post
        Post::create([
            'nim'     => $request->nim,
            'nama'     => $request->nama,
            'alamat'     => $request->alamat,
            'nomorhp'     => $request->nomorhp,
            'motivasikuliah'   => $request->motivasikuliah
        ]);

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //get post by ID
        $post = Post::find($id);

        //return view
        return view('posts.show', compact('post'));
    }

    /**
     * edit
     *
     * @param  mixed $post
     * @return void
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        //validate form
        $this->validate($request, [
            'nim'     => 'required|min:5',
            'nama'   => 'required|min:5',
            'alamat'   => 'required|min:5',
            'nomorhp'   => 'required|min:5',
            'motivasikuliah'   => 'required|min:10'
        ]);

        //update post 
        $post->update([
            'nim'     => $request->nim,
            'nama'     => $request->nama,
            'alamat'     => $request->alamat,
            'nomorhp'     => $request->nomorhp,
            'motivasikuliah'   => $request->motivasikuliah
        ]);


        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Post $post)
    {
        //delete image
        Storage::delete('public/posts/' . $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
