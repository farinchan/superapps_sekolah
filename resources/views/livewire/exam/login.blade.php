<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
            <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" wire:submit.prevent="login">
                    <div class="text-center mb-11">
                        <h1 class="text-gray-900 fw-bolder mb-3">Masuk</h1>
                        <div class="text-gray-500 fw-semibold fs-6">
                            Silahkan masuk menggunakan akun siswa untuk melanjutkan.
                        </div>
                    </div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger d-flex align-items-center p-5">
                            <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-dark">Error</h4>
                                <span>
                                    {{ session('error') }}
                                </span>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('warning'))
                        <div class="alert alert-warning d-flex align-items-center p-5">
                            <i class="ki-duotone ki-shield-cross fs-2hx text-warning me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-dark">Error</h4>
                                <span>
                                    {{ session('warning') }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="fv-row mb-8">
                        <input type="text" placeholder="NISN*" autocomplete="off" class="form-control bg-transparent"
                            wire:model="identifier" />

                        @error('identifier')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="fv-row mb-3">
                        <input type="password" placeholder="Password*" autocomplete="off"
                            class="form-control bg-transparent" wire:model="password" />
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>
                        <a href="#" class="link-primary"
                            onclick="alert('silahkan melapor ke staff admin yang bertanggung jawab')">Lupa Password
                            ?</a>
                    </div>
                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-primary">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
            {{-- <div class="d-flex flex-stack">
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="https://gariskode.com" target="_blank">Support</a>
                    <a href="https://wa.me/6289613390766" target="_blank">Help</a>
                    <a href="{{ env('APP_URL') }}" target="_blank">Main Website</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
