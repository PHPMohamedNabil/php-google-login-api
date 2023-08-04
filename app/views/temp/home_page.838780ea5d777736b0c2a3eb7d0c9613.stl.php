<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('title');?>
<?php echo _esc($user_info['givenName']);?> <?php echo _esc($user_info['familyName']);?> |Profile
<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>   

<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('content');?>

 <div class="row d-flex justify-content-center align-items-center">
   <div class="col-md-6">
     <div class="card mb-4">
       <div class="card-body text-center">
         <img src="<?php echo _esc($user_info['picture']);?>" alt="avatar"
           class="rounded-circle img-fluid" style="width: 150px;"/>
         <h5 class="my-3"><?php echo _esc($user_info['givenName']);?> <?php echo _esc($user_info['familyName']);?></h5>
         <p class="text-muted mb-1"><b>ID</b>:<?php echo _esc($user_info['id']);?></p>
         <p class="text-muted mb-4"><?php echo _esc($user_info['email']);?></p>
       </div>
     </div>
   </div>
 </div>

<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?><?php $view= new App\Core\View\StyleEngine;$view->compileFull('lay');?>