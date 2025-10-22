@extends('layouts.app')
@section('title', 'Create post')

@section('content')
    <div class="container">
        <h1>Create post</h1>
        <div class="mb-4">
            {{-- TODO: Link --}}
            <a href="#"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
        </div>

        {{-- TODO: action, method, enctype --}}
        <form method="post" action="{{ route('posts.store') }}"  enctype="multipart/form-data">
            @csrf

            {{-- TODO: Validation --}}

            <div class="form-group row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Title*</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" " id="title" name="title" value="{{ old('title') }}">
                            @error('title')
        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
    @enderror

                        </div>
                    </div>

                    {{--
            Handling invalid input fields:

            <input type="text" class="form-control is-invalid" ...>
            <div class="invalid-feedback">
                Message
            </div>
        --}}

                    <div class="form-group row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
                            @error('description')
        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
    @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="text" class="col-sm-2 col-form-label">Text*</label>
                        <div class="col-sm-10">
                            <textarea rows="5" class="form-control @error('text') is-invalid @enderror" id="text" name="text">{{ old('text') }}</textarea>
                            @error('text')
        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
    @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="categories" class="col-sm-2 col-form-label py-0">Categories</label>
                        <div class="col-sm-10">
                            {{-- TODO: Read post categories from DB --}}
                              @forelse ($categories as $category)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input @error('categories.*') is-invalid @enderror" value="{{ $category->id }}"
                            id="category-{{ $category->id }}" @checked(in_array($category->id,old('categories',[]))) name=categories[]>
                        {{-- TODO --}}
                        <label for="{{ $category }}" class="form-check-label">
                            <span class="badge bg-{{ $category->style }}">{{ $category->name }}</span>
                        </label>
                        @if ($loop->last && $errors->has('categories.*'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('categories.*') as $errormsg)
                                    {{ $errormsg[0] }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <p>No categories found</p>
                    @endforelse
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="cover_image" class="col-sm-2 col-form-label">Cover image</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="file" class="form-control-file @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
                                @error('cover_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div id="cover_preview" class="col-12 d-none">
                                <p>Cover preview:</p>
                                <img id="cover_preview_image" src="#" alt="Cover preview" width="300px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const coverImageInput = document.querySelector('input#cover_image');
        const coverPreviewContainer = document.querySelector('#cover_preview');
        const coverPreviewImage = document.querySelector('img#cover_preview_image');

        coverImageInput.onchange = event => {
            const [file] = coverImageInput.files;
            if (file) {
                coverPreviewContainer.classList.remove('d-none');
                coverPreviewImage.src = URL.createObjectURL(file);
            } else {
                coverPreviewContainer.classList.add('d-none');
            }
        }
    </script>
@endsection
