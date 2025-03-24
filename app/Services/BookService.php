<?php

namespace App\Services;


use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Repositories\BookRepository;

class BookService{

    protected static $instance;
    private readonly BookRepository $bookRepository;
    protected function __construct(){
        $this->bookRepository = BookRepository::getInstance();
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getById(Book $book){
        return $this->bookRepository->getById($book);
    }
    public function create(BookRequest $request){
        return $this->bookRepository->save($request, null);
    }
    public function update(BookRequest $request, Book $book){
        return $this->bookRepository->save($request, $book);
    }
    public function delete(Book $book){
        return $this->bookRepository->delete($book);
    }

    public function getPaginatedBooks(int $perPage = 6, ?string $query = '')
    {
        return $this->bookRepository->getPaginatedBooks($perPage, $query);
    }

}
