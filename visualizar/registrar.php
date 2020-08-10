        <!--/_______________Tela_de_Login_______________/-->
        <div class="modal fade" id="firefoxModal" tabindex="-1" role="dialog" aria-labelledby="firefoxModalLabel" aria-hidden="true" style="text-align: center;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: inherit;">
                  <span aria-hidden="true">&times;</span>Fechar
                </button>
              </div>
              <div id="accordion" role="tablist">
                <div class="card">
                  <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Faça Login
                      </a>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse show" data-parent="#accordion" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-body">
                      <div class="modal-body">
                        <form action="?logar" method="POST">
                          <input class="form-control" type="email" name="email" placeholder="Digite seu endereço de email" required="">
                          <input class="form-control" type="password" name="senha" placeholder="Digite sua senha" required="" size=""  maxlength="16">
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Entrar</button>
                      </div>
                        </form>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" role="tab" id="headingTwo">
                    <h5 class="mb-0">
                      <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Registre-se
                      </a>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="card-body">
                      <div class="modal-body">
                        <form action="?registrar" method="POST">
                          <input class="form-control" type="text" name="nome" placeholder="Digite um nome de usuario" required="">   
                          <input class="form-control" type="email" name="email" placeholder="Digite seu endereço de email" required="">
                          <label style="">
                            <input class="form-control senha" type="password" name="senha1" placeholder="Digite uma senha" required="" maxlength="16">
                            <input class="form-control senha" type="password" name="senha2" placeholder="Confirmar Senha" required="" maxlength="16">
                          </label>           
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                      </div>
                        </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
