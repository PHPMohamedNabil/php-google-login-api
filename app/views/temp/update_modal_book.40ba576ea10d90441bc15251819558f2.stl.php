<!-- Modal -->
<div class="modal fade" id="update<?php echo _esc($book->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo _esc($book->book_title); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
       <form action="<?php echo _esc(route_name('book.update',[$book->id])); ?>" method="post" enctype="multipart/form-data">
                    <?php echo input_method('put'); ?>
                      <?php echo csrf_input(); ?>
          <input type="hidden" name="book_img_old" value="<?php echo _esc($book->book_img); ?>">
         <div class="form-group">
            <label>book title</label>
            <input type="text" name="book_title" value="<?php echo _esc($book->book_title); ?>" class="form-control" />
               
           <?php if($errors):?>
            <div class="text-danger">
                  <?php echo _esc($errors->first('book_title')); ?>
             </div>
            <?php   endif;   ?>
         </div>
         <div class="form-group">
            <label>book description</label>
            <textarea  name="book_description" class="form-control"><?php echo _esc($book->book_description); ?></textarea>

            <?php if($errors):?>
            <div class="text-danger">
                   <?php echo _esc($errors->first('book_description')); ?>
             </div>
            <?php   endif;   ?>

         </div>
           <div class="form-group">
               <label>book price</label>
            <input type="number" step="0.01" value="<?php echo _esc($book->book_price); ?>" name="book_price" class="form-control col-md-4" />
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
               <input type="file" name="book_img" class="custom-file-input" id="validatedInputGroupCustomFile" >
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
             Save
          </button>
       
       </form>

      </div>
      <div class="modal-footer float-left">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>