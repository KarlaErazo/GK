<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div class="card">
        <div class="card-header">

            <div class="form-row">
                <div class="col-10 pt-1">
                    <span class="pt-3"><b>Listado de Noticias</b></span>
                </div>
                <div class="col-2">
                    <button class="btn btn-outline-secondary btn-sm btn-block" style="float: right !important;" wire:click="openCreateModal()">
                        <i class="fas fa-plus mr-2"></i>Agregar Noticia
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body">

            @foreach($posts as $item)
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-3 bg-gray-500">
                            <img class="img-fluid" src="{{ asset($item->image) }}" alt="notice"
                                 style="width: 100%; height: 100%">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-10 pt-1">
                                        <h5 class="card-title"><b>{{ $item->title }}</b></h5>
                                    </div>
                                    <div class="col-2" style="text-align: right !important;">
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                wire:click="changeView()">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-warning"
                                                wire:click="showPost({{ $item->id }})">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                wire:click="deletePost({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-12">
                                        <small>{{ $item->subtitle }}</small>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <span>{{ substr($item->content, 0, 300) }}...</span>
                                    </div>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="col-2">
                                        <span><b>Tipo Noticia </b></span>
                                    </div>
                                    <div class="col-10">
                                        <span class="text-muted">{{ $item->type }}</span>
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col-2">
                                        <span><b>Autor</b></span>
                                    </div>
                                    <div class="col-6">
                                        <span class="text-muted">{{ $item->autor }}</span>
                                    </div>
                                    <div class="col-4" style="text-align: right !important;">
                                        <span class="text-muted"><b>Fecha</b> {{ $item->date }}</span>
                                    </div>
                                </div>

                                @if($view)
                                    <div class="form-row" mt-3>
                                        <form wire:submit.prevent="savePhoto({{ $item->id }})">
                                            <div class="form-row mt-3">
                                                <div class="col-12">
                                                    <input type="file" wire:model="photo">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="far fa-save"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="create-post-modal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Noticia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="submit" class="needs-validation" novalidate>

                    <div class="modal-body">

                        @csrf

                        <div class="form-row" wire:ignore.self>

                            <div class="col-md-12 mb-3">
                                <label class="required" for="title">Título de la publicación</label>
                                <input type="text" wire:model.defer="title" class="form-control" id="title" value=""
                                       required>
                                <div class="invalid-feedback">Título de la Publicación Obligatorio!</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subtitle">Sub-título de la publicación</label>
                                <input type="text" wire:model.defer="subtitle" class="form-control" id="subtitle"
                                       value="">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="description">Descripción Corta</label>
                                <input type="text" wire:model.defer="description" class="form-control" id="description">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="autor">Autor</label>
                                <input type="text" wire:model.defer="autor" class="form-control" id="autor" required>
                                <div class="invalid-feedback">El autor de la publicación es obligatorio</div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="date">Fecha Publicación</label>
                                <input type="date" wire:model.defer="date" class="form-control" id="date" required>
                                <div class="invalid-feedback">La fecha de la publicación en obligatoria.</div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="type">Tipo Publicación</label>
                                <select wire:model.defer="type" class="custom-select" id="type" required>
                                    <option selected value="">Seleccione...</option>
                                    <option value="Membresía">Membresía</option>
                                    <option value="Coronavirus">Coronavirus</option>
                                    <option value="Medio Ambiente">Medio Ambiente</option>
                                    <option value="Política">Política</option>
                                    <option value="Género">Género</option>
                                    <option value="Derechos">Derechos</option>
                                    <option value="Noticias">Noticias</option>
                                    <option value="Economía">Economía</option>
                                    <option value="Educación">Educación</option>
                                    <option value="Quiero Comer">Quiero Comer</option>
                                    <option value="Tienda">Tienda</option>
                                </select>
                                <div class="invalid-feedback">Seleccione el tipo de publicación.</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="content">Contenido</label>
                                <textarea class="form-control" wire:model.defer="content" id="content"
                                          placeholder="Contenido de la publicación" rows="8" required></textarea>
                                <div class="invalid-feedback">El contenido de la publicación es obligatorio!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="link">Link</label>
                                <input type="text" wire:model.defer="link" class="form-control" id="link">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="references">Referencias</label>
                                <input type="text" wire:model.defer="references" class="form-control" id="references">
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="update-post-modal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Noticia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="updatePost" class="needs-validation" novalidate>

                    <div class="modal-body">

                        @csrf

                        <div class="form-row" wire:ignore.self>

                            <div class="col-md-12 mb-3">
                                <label class="required" for="title">Título de la publicación</label>
                                <input type="text" wire:model.defer="title" class="form-control" id="title" value=""
                                       required>
                                <div class="invalid-feedback">Título de la Publicación Obligatorio!</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subtitle">Sub-título de la publicación</label>
                                <input type="text" wire:model.defer="subtitle" class="form-control" id="subtitle"
                                       value="">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="description">Descripción Corta</label>
                                <input type="text" wire:model.defer="description" class="form-control" id="description">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="autor">Autor</label>
                                <input type="text" wire:model.defer="autor" class="form-control" id="autor" required>
                                <div class="invalid-feedback">El autor de la publicación es obligatorio</div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="date">Fecha Publicación</label>
                                <input type="date" wire:model.defer="date" class="form-control" id="date" required>
                                <div class="invalid-feedback">La fecha de la publicación en obligatoria.</div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="type">Tipo Publicación</label>
                                <select wire:model.defer="type" class="custom-select" id="type" required>
                                    <option selected value="">Seleccione...</option>
                                    <option value="Membresía">Membresía</option>
                                    <option value="Coronavirus">Coronavirus</option>
                                    <option value="Medio Ambiente">Medio Ambiente</option>
                                    <option value="Política">Política</option>
                                    <option value="Género">Género</option>
                                    <option value="Derechos">Derechos</option>
                                    <option value="Noticias">Noticias</option>
                                    <option value="Economía">Economía</option>
                                    <option value="Educación">Educación</option>
                                    <option value="Quiero Comer">Quiero Comer</option>
                                    <option value="Tienda">Tienda</option>
                                </select>
                                <div class="invalid-feedback">Seleccione el tipo de publicación.</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="content">Contenido</label>
                                <textarea class="form-control" wire:model.defer="content" id="content"
                                          placeholder="Contenido de la publicación" rows="8" required></textarea>
                                <div class="invalid-feedback">El contenido de la publicación es obligatorio!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="link">Link</label>
                                <input type="text" wire:model.defer="link" class="form-control" id="link">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="references">Referencias</label>
                                <input type="text" wire:model.defer="references" class="form-control" id="references">
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('openModal', event => {
            $("#create-post-modal").modal('toggle');
        })

        window.addEventListener('closeModal', event => {
            $("#create-post-modal").modal('hide');
        })

        window.addEventListener('openUpdateModal', event => {
            $("#update-post-modal").modal('toggle');
        })

        window.addEventListener('closeUpdateModal', event => {
            $("#update-post-modal").modal('toggle');
        })
    </script>

</div>
