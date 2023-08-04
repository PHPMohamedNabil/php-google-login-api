<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('title');?>
 <?php echo _esc($user_info[0]->first_name);?>  <?php echo _esc($user_info[0]->last_name?'-'.$user_info[0]->last_name:'');?>| Profile
<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>   

<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('content');?>
<div class="row d-flex justify-content-center align-items-center">
   <div class="col-md-6">
    <div class="card mb-4">
       <?php foreach($user_info as $user): ?>
        <div class="card-body text-center">
         <img src="<?php echo _esc($user->profile_pic);?>" alt="avatar"
           class="rounded-circle img-fluid" style="width: 150px;"/>
         <h5 class="my-3"><?php echo _esc($user->first_name);?> <?php echo _esc($user->last_name);?></h5>
         <p class="text-muted mb-1"><b>ID</b>:<?php echo _esc($user->id);?></p>
         <p class="text-muted mb-1"><b>Gender</b>:<?php echo _esc($user->gender);?></p>
         <p class="text-muted mb-1"><b>Local</b>:<?php echo _esc($user->local);?></p>
         <p class="text-muted mb-4"><?php echo _esc($user->email);?></p>
       </div>
      <?php endforeach ?>
    </div>
   </div>
 </div>

<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?><?php $view= new App\Core\View\StyleEngine;$view->compileFull('lay');?>