<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Preencha os dados do curso</h2>
            <p>Estes dados servirão para preencher o seu modelo de certificado escolhido na etapa 1</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="course_name">Título do curso ou palestra</label>
            <input type="text" name="course_name" id="course_name" class="form-control" required>
            <p class="text-muted">Exemplo: Treinamento de SEO</p>
        </div>
        <div class="col-12 form-group">
            <label for="course_instructor">Nome do professor, instrutor ou palestrante</label>
            <input type="text" name="course_instructor" id="course_instructor" class="form-control" required>
            <p class="ext-muted">Exemplo: Ricardo de Freitas</p>
        </div>
        <div class="col-12 form-group">
            <label for="course_date">Realizado(a)</label>
            <input type="text" name="course_date" id="course_date" class="form-control" required>
            <p class="text-muted">Exemplo: em 14 de agosto de 2022</p>
        </div>
        <div class="col-12 form-group">
            <label for="course_locale">Local da realização (opcional)</label>
            <input type="text" name="course_locale" id="course_locale" class="form-control">
            <p class="text-muted">Exemplo: Sesc-PR</p>
        </div>
        <div class="col-12 form-group">
            <label for="course_time">Carga horária</label>
            <input type="text" name="course_time" id="course_time" class="form-control" required>
            <p class="text-muted">Exemplo: 08 horas</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-2">
            <button type="button" class="btn btn-primary btn-lg btn-prev"><?php echo __('Passo anterior', 'gerador-de-certificados-devapps');?></button>
            <button type="button" class="btn btn-primary btn-lg btn-next course" disabled><?php echo __('Próximo passo', 'gerador-de-certificados-devapps');?></button>
        </div>
    </div>
</div>
