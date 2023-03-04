<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-normal-form-section :submit="route('categories.update', $category)" method="PUT">
                <x-slot:title>
                    Ubah kategori
                </x-slot>

                <x-slot:description>
                    Memperbarui data kategori
                </x-slot>

                <x-slot:form>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Nama Kategori') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" name="name" :value="$category->name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" class="hidden"
                            name="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                        <x-jet-label for="photo" value="{{ __('Foto') }}" />

                        @if ($category->profile_photo_path)
                        <div class="mt-2" x-show="! photoPreview">
                            <span class="block rounded-lg h-32 bg-cover bg-no-repeat bg-center"
                            style="background-image: url({{ $category->profile_photo_url }});">
                            </span>
                        </div>
                        @endif
        
                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-lg h-32 bg-cover bg-no-repeat bg-center"
                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
        
                        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Unggah Foto') }}
                        </x-jet-secondary-button>

                        <x-jet-input-error for="photo" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="description" value="{{ __('Deskripsi') }}" />
                        <x-textarea id="description" class="mt-1 block w-full" name="description" :value="$category->description" />
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-jet-button>
                        {{ __('Simpan') }}
                    </x-jet-button>
                </x-slot>
            </x-normal-form-section>
        </div>
    </div>
</x-app-layout>