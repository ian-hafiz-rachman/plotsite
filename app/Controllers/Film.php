<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FilmModel;

class Film extends BaseController
{
    protected $FilmModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->FilmModel = new FilmModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data['films'] = $this->FilmModel->findAll();
        return view('films/index', $data);
    }

    public function add()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        return view('films/add');
    }

    public function store()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $dataFilm = $this->request->getPost();
        $image = $this->request->getFile('image');

        if (!$this->validation->run($dataFilm, 'film')) {
            session()->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $imageName);

            $this->FilmModel->save([
                'title' => $dataFilm['title'],
                'synopsis' => $dataFilm['synopsis'],
                'image' => 'uploads/' . $imageName,
                'trailer' => $dataFilm['trailer'],
                'genre' => $dataFilm['genre'],
                'rilis' => $dataFilm['rilis'],
                'rating' => 0,
                'like' => 0,
                'dislike' => 0,
            ]);

            return redirect()->to('/films');
        } else {
            $error = $image ? $image->getError() : 'File not found';
            return redirect()->back()->withInput()->with('error', "Failed to upload image: $error");
        }
    }

    public function edit($id = null)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data['film'] = $this->FilmModel->find($id);

        if (!$data['film']) {
            return redirect()->to('/films')->with('error', 'Film not found.');
        }

        return view('films/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $dataFilm = $this->request->getPost();
        $film = $this->FilmModel->find($id);

        if (!$this->validation->run($dataFilm, 'film')) {
            session()->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $imageName);
            $dataFilm['image'] = 'uploads/' . $imageName;
        } else {
            $dataFilm['image'] = $film['image'];
        }

        $this->FilmModel->update($id, $dataFilm);

        return redirect()->to('/films');
    }

    public function delete($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $this->FilmModel->delete($id);
        return redirect()->to('/films');
    }

    public function detail($id = null)
    {
        $data['film'] = $this->FilmModel->find($id);

        if (!$data['film']) {
            return redirect()->to('/films')->with('error', 'Film not found.');
        }

        return view('films/detail', $data);
    }

    public function like($id)
    {
        $film = $this->FilmModel->find($id);

        if ($film) {
            if ($film['dislike'] > 0) {
                $film['dislike']--;
            }
            $film['like']++;
            $this->FilmModel->save($film);
            return $this->response->setJSON(['status' => 'success', 'likes' => $film['like'], 'dislikes' => $film['dislike']]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Film not found'], 404);
    }

    public function dislike($id)
    {
        $film = $this->FilmModel->find($id);

        if ($film) {
            if ($film['like'] > 0) {
                $film['like']--;
            }
            $film['dislike']++;
            $this->FilmModel->save($film);
            return $this->response->setJSON(['status' => 'success', 'likes' => $film['like'], 'dislikes' => $film['dislike']]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Film not found'], 404);
    }

    public function rate($id)
    {
        $film = $this->FilmModel->find($id);
        $rating = $this->request->getPost('rating');

        if ($film && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
            $film['rating'] = (($film['rating'] * $film['rating_count']) + $rating) / ($film['rating_count'] + 1);
            $film['rating_count']++;
            $this->FilmModel->save($film);
            return $this->response->setJSON(['status' => 'success', 'rating' => $film['rating']]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid rating'], 400);
    }
}
