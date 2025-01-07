<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="text-success">{{formSuccess.successMessage}}</h3>
                        <h1 class="text-secondary">Add New Item</h1>
                        <router-link :to="{name:'List'}" class="btn btn-sm btn-secondary">Back</router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="storeData">
                            <div class="form-group">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" v-model="formData.product_name">
                                <span class="text-danger" v-for="productNameError in formError.product_name">{{productNameError}}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label">Product Price</label>
                                <input type="number" class="form-control" v-model="formData.product_price">
                                <span class="text-danger" v-for="productPriceError in formError.product_price">{{productPriceError}}</span>
                            </div>
                            <br>
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                formData:{
                    product_name: '',
                    product_price: ''
                },
                formError:{
                    product_name: '',
                    product_price: ''
                },
                formSuccess:{
                    successMessage: ''
                }
            }
        },
        methods:{
            storeData(){
               //console.log(this.formData);
                axios.post('/api/product', this.formData)
                .then((success)=>{
                    //console.log(success.data.message);
                    this.$router.push({name: 'List'});
                    this.formSuccess.successMessage = success.data.message;
                }).catch((error)=>{
                    //console.log(error.response.data.errors);
                    this.formError.product_name = error.response.data.errors.product_name;
                    this.formError.product_price = error.response.data.errors.product_price;
                });
            }
        }
    };
</script>

<style></style>