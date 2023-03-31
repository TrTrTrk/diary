<template>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">
                <p>Check the sentences you want to draw.</p>
            </div>

            <!-- <div v-if="formErrors" class="col-md-4">
                <div class="col-md-4" v-for="(error, index) in errors.all" :key="index">
                    {{ error }}
                </div>
            </div> -->

            <!-- <form @submit.prevent="createPost">return view('make-disp' -->
            <form action="/make-disp" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <div class="col-md-12" v-for="(inptLineCnt, index) in inputLineCount" :key="index">
                    <input type="checkbox" name="checkboxes[]" :value=inptLineCnt placeholder="">
                    <input type="text" name="texts[]" placeholder="">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="Make Picture">
                </div>
            </form>

        </div>
    </div>
</template>

<script>
export default {
    props: {
        inputLineCount: Array
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            checkboxes: [],
            texts: []
        };
    },
    // methods: {
    //     createPost() {           
    //         axios.post('/make-disp', {
    //             checkbox: this.checkboxes,
    //             text: this.texts,
    //             _token:this._token
    //         })
    // //             .then(response => {
    // //                 console.log(response);
    // //             })
    // //             .catch(error => {
    // //                 console.log(error.response);
    // //                 if (error.response.status === 422) {
    // //                     this.formErrors = error.response.data.errors;
    // //                 }
    // //             });
    //     }
    // },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>