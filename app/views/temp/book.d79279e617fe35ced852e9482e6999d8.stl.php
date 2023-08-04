<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('title');?><?php echo _esc($book->book_title);?><?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>

<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('content');?>
   
  <h2 class="name"><?php echo _esc($book->book_title);?></h2>
   <center>                
      <h1>Price:<?php echo _esc($book->book_price);?>$</h1>
   </center>    
 
<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?><?php $view= new App\Core\View\StyleEngine;$view->compileFull('lay');?>