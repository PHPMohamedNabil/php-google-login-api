<?php

namespace App\Controllers;

use App\Models\Book;
use App\Repositories\BookRepository;
use App\Repositories\BookInterface;
use App\Core\Controller;
use Style\Style;
use App\Core\Request;
use Rakit\Validation\Validator;
use App\Core\Url;
use Intervention\Image\ImageManagerStatic as Image;

class BookController extends Controller
{  
	private $book;
	
	public function __construct(BookInterface $book)
	{    
		//middleware_array,except_methods array(optional)
        //$this->middleware(['test'],['index']);
		$this->book = $book;
	}

	public function index(Request $request)
	{   
          
	   // $request->validate(['username'=>'required|min:2']);
       // $book = new Book(12);
		//$book->columns['book_title']='updated';   
		//$book->columns['book_price']=2500000;  
         
       
        //$book->create(['book_title'=>'coding book']); //for mass assignment
		//$book->save(); //for insert
		//$book->amend();// for update
		//$book->purge(); //for delete
		//$book->deleteSoft(12); //for soft delete       
		
		 $books = $this->book::pages(8);
		 $pages = $books['links'];
        
		return view('home',['books'=>$books[0],'links'=>$pages]);

	}

	public function store(Request $request)
	{  
		$request->validate([
                          'book_title'         =>'required|min:4|max:255',
                          'book_description'   =>'required|min:4|max:255',
                          'book_price'         =>'required|numeric',
                          'book_img'           => 'required|uploaded_file:0,1M,png,jpeg,jpg',
		                   ]);	
       
     //  dd($request->file('book_img'));

	    $file_name = $request->file('book_img')->getClientFilename();
        
        $request->book_img=$file_name;
         

        $request->file('book_img')->moveTo(UPLOADS.$file_name);
       
         Image::make(UPLOADS.$file_name)->resize(286 ,286)->save(UPLOADS.$file_name, 91);
         
        $this->book::addBook($request->getBody());

        return Url::redirectWith(route_name('books'),['success'=>'book added  Successfully']);		

	}

	public function update($id,Request $request)
	{  
     
		$request->validate([
                          'book_title'         =>'required|min:4|max:255',
                          'book_description'   =>'required|min:4|max:255',
                          'book_price'         =>'required|numeric',
                          'book_img_old'       =>'required',
                          'book_img'           =>'uploaded_file:0,1M,png,jpeg,jpg',
		                   ]);	
    
	    if($request->hasFile('book_img'))
	    {
	    	 $file_name = $request->file('book_img')->getClientFilename();
	        
           $request->file('book_img')->moveTo(UPLOADS.$file_name);

           Image::make(UPLOADS.$file_name)->resize(286 ,286)->save(UPLOADS.$file_name, 91);      

           $request->book_img=$file_name;

	    }
	    else
	    {
	    	$file_name = $request->book_img_old;
	    	$request->book_img=$file_name;
	    }
         
	    $book = new Book($id);

        $book->columns['book_title']       = $request->book_title;
        $book->columns['book_description'] = $request->book_description;
        $book->columns['book_price']       = $request->book_price;
        $book->columns['book_img']         = $file_name;
    
        if($book->amend())
        {

           return Url::redirectWith(route_name('books'),['success'=>'book added  Successfully']);
        }
        else
        {  
        	
         	return Url::redirectWith(route_name('books'),['error'=>'Request error please try again']);

        }   
		

	}

	public function destroy(Request $request)
	{    
		 $book= $this->book::book($request->id);
             
             clearstatcache();
		if(file_exists(UPLOADS.$book->book_img))
		{
			 @unlink(UPLOADS.$book->book_img);
		}

          $this->book::delete($request->id);
		  return Url::redirectWith(route_name('books'),['success'=>'book deleted Successfully']);
	}

	public function show($id)
	{ 
		return view('book',['book'=>$this->book::book($id)]);
	}

	public function test(Request $request)
	{  
        
		   /*if($request->hasFile('upload'))
		   {
		   	  
		   	  dd($request->file);
		   }*/

		 return view('test',[]);
	}



}