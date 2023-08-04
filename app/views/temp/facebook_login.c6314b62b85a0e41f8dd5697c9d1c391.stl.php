<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('title');?>Facebook|Login<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>   

<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('content');?>

<div class="row">
   <div class="col-md-6">
      
      <h3 class="text-center">Login with facebook Api</h3>
      
   </div>
</div>
<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?>
<?php $view= new App\Core\View\StyleEngine;$view->sectionStart('script');?>
<script  type="text/javascript">

    function confirmation()
    {

         if(confirm('are you sure you want to procced to the action?'))
         {
            return true;
         }
         return false;
    }
</script>
<?php $view= new App\Core\View\StyleEngine;$view->sectionEnd();
		           ?><?php $view= new App\Core\View\StyleEngine;$view->compileFull('lay');?>