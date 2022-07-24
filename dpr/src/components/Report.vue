<template>
    <main class="bg-white p-3 my-2">
        <div class="mb-3">
            <label for="title" class="form-label">Judul Aspirasi</label>
            <input type="email" class="form-control" id="title" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="information" class="form-label">Keterangan</label>
            <textarea class="form-control" id="information" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Gambar</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        
        <nav class="navbar px-3 bg-white fixed-bottom shadow-lg justify-content-end" style="max-width: 460px; margin: 0 auto">
            <router-link :to="{ name:'report' }" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg>
                Kirim
            </router-link>
        </nav>
    </main>
</template>