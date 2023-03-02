 <form class="user" method="post">
     @csrf
     <div class="form-group">
         <input type="text" class="form-control form-control-user" id="user" name="nome" required
             placeholder="Usuário ou e-mail">
     </div>
     <div class="form-group">
         <input type="password" class="form-control form-control-user" id="password" name="senha" required
             placeholder="Senha">
     </div>
     <button class="btn btn-primary btn-user btn-block">
         Acessar
     </button>
 </form>
 <hr class="hr-login">
 <a href="/recuperar-senha" class="btn-acesso">
     Não está conseguindo acessar?<span>clique aqui!</span>
 </a>
