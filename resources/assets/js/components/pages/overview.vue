<<template>
    <div>
        <div class="row page-title">
            <div class="col">
                <h1>Overview</h1>
            </div>
        </div>
        <div class="row btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
            <div class="col btn-group btn-group-sm" role="group" aria-label="Input group buttons">
                <button type="button" v-for="inputs in inputGroups" 
                    @click.prevent="cardCollapse(inputs.id)"
                    class="btn btn-save"
                    :class="determineActiveInputGroup(inputs.id)">{{inputs.heading}}</button>
            </div>
            <!-- <div class="col d-block d-md-none btn-group btn-group-sm" role="group" aria-label="Sidebar buttons">
                <button type="button" 
                    class="btn btn-save" 
                    v-for="link in sideBarLinks"
                    :class="knowActiveSidebarClass(link.name)"
                    @click.prevent="changeActiveSidebar(link.name)">{{link.title}}</button>
            </div> -->
        </div>
        
        <div class="row">
            <div class="col-sm-12"  v-for="inputs in inputGroups">
                <div class="card">
                    <div :id="`${inputs.id}_title`" class="card-title">
                        <a href="#"  @click.prevent="cardCollapse(inputs.id)">
                            <h4 class="heading">{{inputs.heading}}</h4>
                            <span class="float-right clickable"><i :id="`${inputs.id}_arrow`" class="align-middle fas" :class="arrowClass(inputs.id)"></i></span>
                        </a>
                    </div>
                    <div :id="`${inputs.id}_body`" class="card-body animated delay-1s">
                        <input-component v-bind:is="inputs.componentName"></input-component>
                    </div>
                </div>
                
            </div>
            <!-- <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <p>this is just text</p><br><br>
                            <p>this is just text</p><br><br>
                            <p>this is just text</p><br><br>
                            <p>this is just text</p><br><br>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>

<<script>
export default {
    props: ['sideBarLinks', 'selectedSidebar'],
    data(){
        return{
            inputGroups: [
                {id: "basic_info", componentName: "basic-info-component", heading: "Basic Info"},
                {id: "career_info", componentName: "career-info-component", heading: "Career Info"},
                {id: "basic_info2", componentName: "basic-info-component", heading: "Basic Info 2"}
            ],
            selectedInputComponent: {}
        }
    },
    mounted(){
        this.initSelectedInputComponent();
        this.removeErrorOnInput();
        // this.listenSelectedCardId();
        this.listenErrorForInputs();
    },
    computed:{
        
    },
    methods: {
        knowActiveSidebarClass(name){
            return {
                'active-input-group-button' : this.selectedSidebar === name
            }
        },
        changeActiveSidebar(name){
            this.$hub.$emit('subscribeToChangeActiveSidebar', name);
        },
        determineActiveInputGroup(id){
            return {
                'active-input-group-button' : this.selectedInputComponent.id === id
            }
        },
        listenErrorForInputs(){
            let instance = this;
            this.$hub.$on('showInputValidationError', (idHint,value) => {
                instance.showError(idHint,value);
            });
        },
        arrowClass(idName){
            return{
                'fa-angle-down' : this.selectedInputComponent.id === idName,
                'fa-angle-right xtra-margin-left' : this.selectedInputComponent.id !== idName
            }
        },
        initSelectedInputComponent(){
            let instance = this;
            this.inputGroups.forEach(element => {
                if(_.isEmpty(instance.selectedInputComponent)){
                    instance.cardCollapse(element.id);
                }
            });
        },
        removeErrorOnInput(){
            $(document).on('input', '.form-control', function () {
                let instance = $(this);
                if(instance.hasClass('is-invalid')){
                    instance.removeClass('is-invalid');
                    instance.siblings('.error-message').addClass('d-none');
                }
            })
        },
        cardCollapse(idHint){
            let inst = this;
            console.log("inst.selectedInputComponent",inst.selectedInputComponent);
            this.inputGroups.forEach((element,index) => {
                let instance = $(`#${element.id}_body`);
                
                if(!_.isEmpty(inst.selectedInputComponent) && inst.selectedInputComponent.id === element.id){
                    console.log("firstCond");
                    this.cardCollapse(index+1);
                    return false;
                } else {
                    if(element.id !== idHint){
                        console.log("secondCond");
                        if(!instance.hasClass('card-collapsed')){
                            instance.slideUp();
                            instance.addClass('card-collapsed');
                        }
                    } else {
                        console.log("thirdCond");
                        inst.selectedInputComponent = element;
                        instance.slideDown();
                        if(instance.hasClass('card-collapsed')) instance.removeClass('card-collapsed');
                    }
                }

                
            });
            
            
        },
        
        showError(idHint,value){
            $('#'+idHint).addClass("is-invalid");
            if(value == "default"){
                $("#"+idHint+"_error").removeClass("d-none").html("This is a required field");
            } else {
                $("#"+idHint+"_error").removeClass("d-none").html(value);
            }
        }
    }
}
</script>

