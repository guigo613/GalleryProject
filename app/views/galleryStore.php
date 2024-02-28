<!DOCTYPE html>
<html>
<head>
    <title>Lista de Livros</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="app">
        <div class="container center-app">
            
            <?php

            echo "<div class='row'>
                    <div class='col'><h1>Galeria</h1></div>
                    <div class='col-2 ms-auto'>
                        <div class='row'>
                            <div class='col-6'>
                                <button type='button' class='btn btn-primary' onclick=\"location.search = '?route=logout'\">logout</button>
                            </div>
                        </div>";

            echo    "</div>
                </div>";
            
            echo "<div class='table-container'>
                    <div class='row'>";

            foreach ($gallery->inner as $image) {
                echo    "<div class='col-3 mb-3'>
                            <div class='card' style='width: 18rem;'>
                                <img src='data:image/jpeg;base64,{$image->img}' style='object-fit: cover;' class='card-img-top' width='200' height='200' alt='{$image->alt}'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$image->title}</h5>
                                    <p class='card-text'>{$image->alt}</p>
                                </div>
                                <div class='card-footer'>
                                    <form action='?route=removeimage' method='post'>
                                        <input type='hidden' name='image_id' value='{$image->id}'>
                                        <button type='submit' class='btn btn-danger'>Remover</button>
                                    </form>
                                </div>
                            </div>
                        </div>";
            }

            echo    "</div>
                </div>";

            
            echo 
                "<form action='?route=addimage' method='post' style='display: inline; margin-left: 10px;' enctype='multipart/form-data'>
                    <div class='input-group mb-3'>
                        <input required type='file' class='form-control' placeholder='Image' name='img'>

                        <span class='input-group-text' id='label-title'>Titulo</span>
                        <input required type='text' class='form-control' placeholder='Titulo' name='title'>
                        
                        <span class='input-group-text' id='label-alt'>Descricao</span>
                        <input required type='text' class='form-control' placeholder='Descricao' name='alt'>
                    </div>

                    <input class='btn btn-primary' type='submit' value='Adicionar'>
                </form>";

            ?>
        </div>
    </div>
    <div class="modal fade" id="modalImage" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkAAIAAAoAAv/lxKUAAAAASUVORK5CYII=" style='object-fit: contain; height: 70vh;' class='card-img-top' width='200' height='200'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>
    <script src="/public/js/bootstrap.bundle.min.js"></script>
    <script>
        function open(e) {
            let img = e.currentTarget.querySelector("img")

            let modal = document.querySelector("#modalImage");
            let imgModal = modal.querySelector("img");
            modal.querySelector("#modalTitle").innerText = e.currentTarget.querySelector(".card-title").innerText;
            imgModal.src = img.src

            new bootstrap.Modal(modal).show()
        }

        Array.from(document.querySelectorAll(".card")).map(e => e.addEventListener("click", open))
    </script>
</body>
</html>