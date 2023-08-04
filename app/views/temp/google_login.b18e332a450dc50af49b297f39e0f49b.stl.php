<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('title');?>Google|Login<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>   

<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('content');?>

<div class="row d-flex justify-content-center align-items-center">
   <?php if(session()->has('error')):?>
       <div class="col-md-6 ">
           <div class="alert alert-danger alert-dismissible"  role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo _esc(session()->flush('error')); ?></strong>
           </div>
       </div>
   <?php   endif;   ?>
   <div class="col-md-6 ">
      <p class="text-center"> 
         <a href="<?php echo _esc($login_url);?>" class="btn btn-light">
            <img src="https://tinyurl.com/46bvrw4s" alt="Google Logo"> Login with Google
         </a>
      </p>
      
   </div>
</div>

<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?><?php $view= new App\Core\View\StyleEngine;$view->compileFull('lay');?>