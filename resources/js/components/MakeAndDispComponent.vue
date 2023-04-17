<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row my-5">
                <div class="col text-center">
                    <div><img :src='"storage/" + dirName + "/" + fileName' alt="" /></div>
                </div>
                <div class="col">
                    <p name="sentence[]" v-for="(count, index) in inputLineCount" :key="index">
                        {{ sentences[count] }}
                    </p>
                </div>
            </div>
            <div v-if='route == "disp"' class="row text-center my-5">
                <div v-if='isUser' class="col">
                    <a class="btn btn-danger" :href='"/delete?imageName=" + fileName + "&dirName=" + dirName'>delete</a>
                </div>
                <div class="col">
                    <a class="btn btn-primary" href="/">back</a>
                </div>
            </div>
            <div v-else class="row text-center my-5">
                <div class="col">
                    <a class="btn btn-success" href="/confirm">confirm</a>
                </div>
                <div class="col">
                    <a class="btn btn-info" href="/cancel">cancel</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: {
        fileName: String,
        dirName: Number,
        sentences: Array,
        inputLineCount: Array,
        route: String,
        isUser: Boolean,
    },  
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
    }
}
</script>
