<template>
    <div class="container">
        <div class="row justify-content-center my-2" v-if="canMakePic">
            <div class="col-md-8"></div>
            <div class="col-md-4 text-center">
                <a class="btn btn-primary" href="/input">make diary</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center my-2" v-for="(picItem, index) in picItems" :key="index">
                <div class="card">
                    <a :href='"/disp?imageName=" + picItem.imageName'>
                        <img class="border border-dark" :src='"./storage/" + picItem.id + "/" + picItem.imageName'
                            :alt="picItem.sentences" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        picItems: Array,
        canMakePic: Boolean
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
