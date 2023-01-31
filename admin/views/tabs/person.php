<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Informe os dados dos participantes/alunos</h2>
            <!--<p>Você pode cadastrar manualmente ou enviar um arquivo excel.</p>-->
        </div>
    </div>
    <div class="row my-4">
        <div class="col-12 col-md-3 form-group">
            <label for="person_name">Nome Completo</label>
            <input type="text" id="person_name" class="form-control" placeholder="Ex: Ricardo de Freitas" required>
        </div>
        <div class="col-12 col-md-2 form-group">
            <label for="person_cpf">CPF</label>
            <input type="text" id="person_cpf" class="form-control" placeholder="Ex: 123.456.789-00" required>
        </div>
        <div class="col-12 col-md-3 form-group">
            <label for="person_email">E-mail</label>
            <input type="email" id="person_email" class="form-control" placeholder="Ex: contato@dominio.com" required>
        </div>
        <div class="col-12 col-md-2 form-group">
            <label for="person_email" class="w-100">&nbsp;</label>
            <button type="button" class="btn btn-secondary" id="btn_add_person">Adicionar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-sm" id="person_table">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Nome Completo</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="empty_table">
                        <td colspan="4">
                            <p class="text-muted text-center">Nenhum participante/aluno foi adicionado.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-2">
            <button type="button" class="btn btn-primary btn-lg btn-prev">
                <?php echo __('Passo anterior', 'devapps-certificate-generator'); ?>
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-next person" disabled>
                <?php echo __('Próximo passo', 'devapps-certificate-generator'); ?>
            </button>
        </div>
    </div>
</div>