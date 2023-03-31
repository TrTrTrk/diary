<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div><img :src='"storage/" + filePath' alt="" /></div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4" style="writing-mode: vertical-rl;">
                    <p v-for="(count, index) in inputLineCount" :key="index">
                        {{ sentences[count] }}
                    </p>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <a class="btn btn-primary" href="/confirm">confirm</a>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary" href="/cancel">cancel</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        filePath: String,
        sentences: Array,
        inputLineCount: Array
    },
    // data() {
    //     return {
    //         imgUrl:require("@/assets/storage/" + filePath)
    //     }
    // },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        asset(path) {
            var base_path = window._asset || '';
            return base_path + path;
        },
    }
}
</script>
