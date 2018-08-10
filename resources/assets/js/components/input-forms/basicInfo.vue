<template>
    <div class="card-text">
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" id="first_name" class="form-control" :class="showInputLoading('first_name')" @input="processTheData('first_name')" v-model="dataset.first_name">
                <span v-show="showLoader('first_name')" class="circle-loader-input"></span>
                <div id="first_name_error" class="text-danger error-message d-none"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" id="last_name" class="form-control" :class="showInputLoading('last_name')" @input="processTheData('last_name',2000)" v-model="dataset.last_name">
                <span  v-show="showLoader('last_name')" class="circle-loader-input"></span>
                <div id="last_name_error" class="text-danger error-message d-none"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Present Address</label>
            <div class="col-sm-10">
                <textarea type="text"  id="present_address" class="form-control" :class="showInputLoading('present_address')" @input="processTheData('present_address',2500)" rows="2" v-model="dataset.present_address"></textarea>
                <span v-show="showLoader('present_address')" class="circle-loader-input"></span>
                <div id="present_address_error" class="text-danger error-message d-none"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Permanent Address</label>
            <div class="col-sm-10">
                <textarea type="text" id="permanent_address" class="form-control" :class="showInputLoading('permanent_address')" @input="processTheData('permanent_address',3000)" rows="2" v-model="dataset.permanent_address"></textarea>
                <span v-show="showLoader('permanent_address')" class="circle-loader-input"></span>
                <div id="permanent_address_error" class="text-danger error-message d-none"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Birthday</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <select id="date_of_birth_year" class="form-control" :class="showInputLoading('date_of_birth_year')" @input="processTheData('date_of_birth_year')" v-model="dataset.date_of_birth_year" @change="initDaysOfThisMonth()">
                            <option selected value="">Year</option>
                            <option v-for="year in years" :value="year">{{year}}</option>
                        </select>
                        <span v-show="showLoader('date_of_birth_year')" class="circle-loader-input"></span>
                        <div id="date_of_birth_year_error" class="text-danger error-message d-none"></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <select id="date_of_birth_month" class="form-control" :class="showInputLoading('date_of_birth_month')" @input="processTheData('date_of_birth_month')" v-model="dataset.date_of_birth_month" @change="initDaysOfThisMonth()">
                            <option selected value="">Month</option>
                            <option v-for="month in months" :value="month">{{month}}</option>
                        </select>
                        <span v-show="showLoader('date_of_birth_month')" class="circle-loader-input"></span>
                        <div id="date_of_birth_month_error" class="text-danger error-message d-none"></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <select id="date_of_birth_day" class="form-control" :class="showInputLoading('date_of_birth_day')" @input="processTheData('date_of_birth_day')" v-model="dataset.date_of_birth_day">
                            <option selected value="">Day</option>
                            <option v-for="day in days" :value="day">{{day}}</option>
                        </select>
                        <span v-show="showLoader('date_of_birth_day')" class="circle-loader-input"></span>
                        <div id="date_of_birth_day_error" class="text-danger error-message d-none"></div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="form-group row float-right save-button">
            <button type="submit" class="btn btn-save" @click.prevent="validate(dataset),save()">Save Changes</button>
        </div>
        <p v-for="user in users">{{user.name}}</p>
        <span class="circle-loader-input"></span>
    </div>
    
</template>


<<script>
export default {
    data(){
        return{
            dataset: {
                first_name: "Prosenjit",
                last_name: 'Chowdhury',
                present_address: '',
                permanent_address: '',
                date_of_birth_year: '',
                date_of_birth_month: '',
                date_of_birth_day: ''
            },
            years: [], // to manipulate select options
            months: [], // to manipulate select options
            days: [], // to manipulate select options
            isNotValid: false,
            users: [],
            inputsToBeSaved: [],
            typingTimer: null,
        }
    },
    computed: {
        // showLoader(input_name){
        //     let instance = this;
        //     Object.keys(this.inputsToBeSaved).forEach(key => {
        //         if(instance.inputsToBeSaved[key] == input_name){
        //             console.log("trueLoader",key,instance.inputsToBeSaved,input_name)
        //             return true;
        //         }
        //         else return false;
        //     });
        // }
    },
    mounted(){
        this.getOptionsForDaysMonthsYears();
        this.getAllUser();
        this.save();
    },
    methods: {
        showInputLoading(input){
            // if(this.inputsToBeSaved.length > 0){
            //     this.inputsToBeSaved.forEach(element => {
            //         if(element === input) return 'load-effect-input';
            //     });
            // }
            if(_.includes(this.inputsToBeSaved,input)) return 'load-effect-input';
        },
        processTheData(val,delay=1000){
            if(!_.isNull(this.typingTimer)){
                this.typingTimer = clearTimeout(this.typingTimer);
                console.log("cleared");
            }
            this.typingTimer = setTimeout(() => {
                console.log("inp",this.dataset[val]);
                if(this.dataset[val]) this.finalizeInputs(val);
            }, delay);
        },
        finalizeInputs(value){
            let instance = this;
            if( value == 'date_of_birth_year' || 
                value == 'date_of_birth_month' || 
                value == 'date_of_birth_day')
            {
                if( this.dataset.date_of_birth_year && 
                    this.dataset.date_of_birth_month &&
                    this.dataset.date_of_birth_day)
                {
                    instance.addToInputsToBeSaved('date_of_birth_year');
                    instance.addToInputsToBeSaved('date_of_birth_month');
                    instance.addToInputsToBeSaved('date_of_birth_day');
                }
            } else {
                instance.addToInputsToBeSaved(value);
                instance.save();
                console.log("final input", value);
                instance.$hub.$emit('showAnAlert',`Input finished - ${instance.dataset[value]}`,'success');
                // if(instance.showLoader(value)) console.log('finInp',value);
                
            }
        },
        addToInputsToBeSaved(val){
            this.inputsToBeSaved.push(val);
            console.log("added", val, this.inputsToBeSaved)
        },
        removeFromInputsToBeSaved(val){
            this.inputsToBeSaved = _.without(this.inputsToBeSaved,val);
            console.log("romoved", val, this.inputsToBeSaved);
        },
        showError(id,value = 'default'){
            this.$hub.$emit('showInputValidationError',id,value);
        },
        getOptionsForDaysMonthsYears(){
            let instance = this;
            if(!this.dataset.date_of_birth_year && !this.dataset.date_of_birth_month && !this.dataset.date_of_birth_day){
                let daysCountOfThisMonth = moment(moment()).daysInMonth();
                for(let i=1; i<=daysCountOfThisMonth; i++){
                    instance.days.push(i)
                }
                
                for(let i=1; i<=12; i++){
                    instance.months.push(moment(i,'M').format('MMM'));
                }

                for(let i=1950; i<moment(moment()).format('YYYY'); i++){
                    instance.years.push(i);
                }
            }
        },
        initDaysOfThisMonth(){
            let instance = this;
            if(this.dataset.date_of_birth_year && this.dataset.date_of_birth_month){
                let daysCountOfThisMonth = moment(this.dataset.date_of_birth_month+" "+this.dataset.date_of_birth_year,"MMM YYYY").daysInMonth();
                instance.days = [];
                for(let i=1; i<=daysCountOfThisMonth; i++){
                    instance.days.push(i)
                }
                
                if(instance.dataset.date_of_birth_day){
                    let dayFound = instance.days.find((element) => {
                        return element === instance.dataset.date_of_birth_day;
                    });
                    if(!dayFound){
                        instance.dataset.date_of_birth_day = "";
                    }
                }
            }
        },
        save(){
            let instance = this;
            // if(!instance.isNotValid){
                if(instance.inputsToBeSaved.length > 0){
                    instance.inputsToBeSaved.forEach(element => {
                        console.log('submitted', instance.dataset[element], element);
                    });
                }
            // }
        },
        checkIfNull(value,key){
            value = _.trim(value);
            if(value == ""){
                this.showError(key);
                this.isNotValid = true;
            }
        },
        validate(dataObject,previousKey=null) {
            let instance = this;
            Object.keys(dataObject).forEach(key => {
                let elementIdHint = key,
                    value = _.trim(dataObject[key]);
                if(!_.isNull(previousKey)) elementIdHint = `${previousKey}_${elementIdHint}`;
                if(!dataObject[key] || dataObject[key] == "") {
                    instance.showError(elementIdHint);
                    instance.isNotValid= true;
                }
            });
        },
        getAllUser(){
            axios.get('/get-all-user').then(response => {
                this.users = response.data;
            }).catch(e => {
                console.log('error', e, typeof e);
            })
        },
        showLoader(input_name){
            // let instance = this;
            // Object.keys(this.inputsToBeSaved).forEach(key => {
            //     if(instance.inputsToBeSaved[key] == input_name){
            //         console.log("trueLoader",key,instance.inputsToBeSaved,input_name)
            //         return true;
            //     }
            //     else return false;
            // });
            if(_.includes(this.inputsToBeSaved,input_name)) return true;
        }
    }
}
</script>
