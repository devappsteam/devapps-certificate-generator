<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Defina o modelo de certificado que vai utilizar</h2>
            <p>Você pode escolher entre os modelos pré-definidos ou enviar um modelo seu</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="jumbotron py-3">
                <p><b>Você pode enviar qualquer modelo de certificado, mas atenção às especificações técnicas:</b></p>
                <ul class="default-list">
                    <li>O arquivo deve ser enviado em formato <b>jpg;</b></li>
                    <li>O arquivo deve ter no máximo <b>1MB</b>;</li>
                    <li>Tamanho de <b>1811x1299px</b> (paisagem). Este é o tamanho recomendável para que seu certificado A4 fique melhor configurado;</li>
                    <li>Caso deseje incluir logo e assinatura nos certificados, as mesmas devem fazer parte da imagem de modelo que você vai enviar.</li>
                </ul>
                <form method="POST" enctype="multipart/form-data" id="form_upload_model_file">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="upload_model_file" name="upload_model_file" aria-describedby="upload_model" accept=".jpg">
                            <label class="custom-file-label" for="upload_model_file" data-browse="Pesquisar"><?php echo __('Selecionar arquivo...', DEVAPPS_CERTIFICATE_GENERATOR_TEXT_DOMAIN);?></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary"><?php echo __('Carregar modelo', DEVAPPS_CERTIFICATE_GENERATOR_TEXT_DOMAIN); ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Modelos de Certificados</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-2">
            <div class="certificate_preview">
                <input type="radio" name="model" class="model-check" id="model_default" value="default">
                <label for="model_default">
                    <div class="image-preview" style="background-image: url('<?php echo DEVAPPS_CERTIFICATE_GENERATOR_URL . "models/default.jpg";?>');"></div>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-2">
            <button type="button" class="btn btn-primary btn-lg btn-next models" disabled><?php echo __('Próximo passo', DEVAPPS_CERTIFICATE_GENERATOR_TEXT_DOMAIN);?></button>
        </div>
    </div>
</div>