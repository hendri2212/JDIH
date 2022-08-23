<template>
    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <router-link :to="{ name: 'aspiration' }" class="btn btn-sm text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </router-link>
            <img style="height:50px; aspect-ratio:1;" src="@/assets/logo.png" alt="">
        </div>
    </div>
</template>