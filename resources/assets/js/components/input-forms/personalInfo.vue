<template>
    <div class="card-text">
        <div class="form-group row">
            <label for="fathers_name" class="col-sm-2 col-form-label">Fathers Name</label>
            <div class="col-sm-10">
                <input type="text" id="fathers_name" class="form-control" :class="showInputLoading('fathers_name')" @input="processTheData('fathers_name')" v-model="dataset.fathers_name">
                <span v-show="showLoader('fathers_name')" class="circle-loader-input"></span>
                <div id="fathers_name_error" class="text-danger error-message d-none"></div>
            </div>
        </div>
        <div class="form-group row float-right save-button">
            <button type="submit" class="btn btn-save" @click.prevent="validate(dataset),save()">Next</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return{

        }
    }
}
</script>
