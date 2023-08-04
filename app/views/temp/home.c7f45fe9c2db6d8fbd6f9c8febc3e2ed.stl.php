<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('title');?>Books<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>   

<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('content');?>

<div class="row">
   <div class="col-md-6">
      
      <?php if(session()->has('error')):?>
         <div class="alert alert-danger" role="alert">
           <?php echo _esc(session()->flush('error')); ?>
         </div>
      <?php   endif;   ?>
       <?php if(session()->has('success')):?>
         <div class="alert alert-success" role="alert">
           <?php echo _esc(session()->flush('success')); ?>
         </div>
      <?php   endif;   ?>
      <h3>Add book</h3>
      
</div>
</div>

  <div class="row mt-4">
    
     <?php foreach($books as $book): ?>
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="<?php echo _esc(upload($book->book_img)); ?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo _esc($book->book_title);?></h5>
                <p class="card-text">
                     <?php echo _esc($book->book_description);?>
                </p>
                <div class="row justify-content-center">
                  <cite class="float-left text-center">
                   <?php echo _esc($book->book_price); ?>$
                </cite>
                </div>
                 <div class="row">
                    <div class="col-md-4">
                          <form action="<?php echo _esc(route_name('delete.book',[$book->id])); ?>" method="post" onsubmit="return confirmation();">
                       <?php echo input_method('delete'); ?>
                       <?php echo csrf_input(); ?>
                       <input type="hidden" name="id" value="<?php echo _esc($book->id); ?>">
                       <button type="submit" class="btn btn-danger">Delete</button>
                     </form>
                    </div>
                    <div class="col-md-4">
                       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update<?php echo _esc($book->id); ?>">Update</button>
                     </form>
                    </div>
                 </div>
              </div>
           </div>
        </div> 


   <!-- update modal--> 

  <?php $display=new App\Core\View\Style('C:\xampp\htdocs\bookstore\app\views','C:\xampp\htdocs\bookstore\app\views\temp');$display->render('update_modal_book',['book'=>$book,'errors'=>$errors]);?>


     <?php endforeach ?>  
    
  </div>

<center><?php echo $links; ?></center>

<!-- Modal -->
<div class="modal fade" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
       <form action="<?php echo _esc(route_name('book.store')); ?>" method="post" enctype="multipart/form-data">
         <?php echo csrf_input(); ?>
         <div class="form-group">
            <label>book title</label>
            <input type="text" name="book_title"value="<?php echo _esc(old_body('book_title')); ?>" class="form-control" />
               
           <?php if($errors):?>
            <div class="text-danger">
                  <?php echo _esc($errors->first('book_title')); ?>
             </div>
            <?php   endif;   ?>
         </div>
         <div class="form-group">
            <label>book description</label>
            <textarea  name="book_description" class="form-control"><?php echo _esc(old_body('book_description')); ?></textarea>

            <?php if($errors):?>
            <div class="text-danger">
                   <?php echo _esc($errors->first('book_description')); ?>
             </div>
            <?php   endif;   ?>

         </div>
           <div class="form-group">
               <label>book price</label>
            <input type="number" step="0.01" name="book_price" class="form-control col-md-4" value="<?php echo _esc(old_body('book_price')); ?>" />
           <?php if($errors):?>
            <div class="text-danger">
                    <?php echo _esc($errors->first('book_price')); ?>
             </div>
          <?php   endif;   ?>
         </div>
          
         <div class="form-group">
             <label>Book Image:</label>
            <div class="input-group">
             <div class="custom-file">
               <input type="file" name="book_img" class="custom-file-input" id="validatedInputGroupCustomFile" required>
               <label class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
             </div>
            </div>
          <?php if($errors):?>
            <div class="text-danger">
             <?php echo _esc($errors->first('book_img')); ?>
             </div>
         <?php   endif;   ?>
         </div>      
   
          <button type="submit" class="btn btn-primary float-right mt-3"/>
             Create Book
          </button>
       
       </form>

      </div>
      <div class="modal-footer float-left">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>
<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('script');?>
<script  type="text/javascript">

    function confirmation()
    {

         if(confirm('are you sure you want to delete the book?'))
         {
            return true;
         }
         return false;
    }
</script>
<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?><?php $view= new App\Core\View\StyleEngine;$view->compileFull('lay');?>