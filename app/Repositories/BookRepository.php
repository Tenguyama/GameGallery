<?php

namespace App\Repositories;

use App\Http\Requests\BookRequest;
use App\Models\Book;

class BookRepository {
    protected static $instance;

    private readonly Book $model;

    public function __construct(){
        $this->model = new Book();
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getById(Book $book){
        return $this->model->query()->findOrFail($book->id);
    }
    public function save(BookRequest $request, ?Book $book){
        $params = [
            'title' => $request->input('title'),
            'developer' => $request->input('developer'),
            'genre' => $request->input('genre'),
            'release_date' => $request->input('release_date'),
            'platform' => $request->input('platform'),
            'price' => $request->input('price'),
            'img_url' => $request->input('img_url'),
            'image' => $request->input('image'),
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $params['img_url'] = "/storage/$path";
        }
        unset($params['image']);

        if(isset($book) and !empty($book)){
            $result = $this->model->query()->updateOrCreate([
                'id'=>$book->id
            ], $params);
        }else{
            $result = $this->model->query()->create($params);
        }

        return $result;
    }
    public function delete(Book $book){
        return $book->delete();
    }

    public function getPaginatedBooks(int $perPage = 6, ?string $query = '')
    {
        $query = strtolower($query ?? '');
        return $this->model
            ->whereRaw('LOWER(title) LIKE ?', ["%{$query}%"])
            ->orWhereRaw('LOWER(developer) LIKE ?', ["%{$query}%"])
            ->orWhereRaw('LOWER(genre) LIKE ?', ["%{$query}%"])
            ->orWhereRaw('LOWER(platform) LIKE ?', ["%{$query}%"])
            ->paginate($perPage);
    }
}
