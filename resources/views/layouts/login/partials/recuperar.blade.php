<form class="user" method="post">
     @csrf
     <div class="form-group">
         <input type="text" class="form-control form-control-user" id="user" name="nome" required
             placeholder="Usuário ou e-mail">
     </div>
     <button class="btn btn-primary btn-user btn-block">
         Solicitar recuperação
     </button>
 </form>
