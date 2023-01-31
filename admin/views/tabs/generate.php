<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Esta pronto pra gerar os certificados!</h2>
            <p>Confira sua lista de participantes/alunos.</p>
            <p>Para o primeiro nome da lista você pode gerar um certificado de teste. Caso perceba que algo não tenha ficado como esperado, você ainda pode voltar aos passos anteriores.</p>
            <p>Caso deseje disponibilizar um meio de consulta, adicione o shortcode em sua página <code>[devapps-certificate-search]</code></p>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="form-check form-check-inline p-0">
                <input class="form-check-input" type="checkbox" value="1" id="send_mail">
                <label class="form-check-label font-weight-bold" for="send_mail">
                    Deseja enviar os certificados gerados por E-mail?
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-sm" id="preview_generate">
                <thead>
                    <tr class="bg-dark text-light">
                        <th width="50">#</th>
                        <th>Participante/Aluno</th>
                        <th>Documento</th>
                        <th>E-mail</th>
                        <th width="200">Status</th>
                        <th width="200">Ação</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center mt-2">
            <button type="button" class="btn btn-primary btn-lg btn-prev"><?php echo __('Passo anterior', 'devapps-certificate-generator');?></button>
            <button type="button" class="btn btn-success btn-lg btn-generate"><?php echo __('Gerar Certificados', 'devapps-certificate-generator');?></button>
        </div>
    </div>
</div>