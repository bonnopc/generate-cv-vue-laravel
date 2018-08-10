<<template>
    <div class="row alert-container" v-if="alerts.length > 0">
        <div v-for="(alert,index) in alerts"
            class="alert animated zoomInRight delay-0.5s"
            :class="determineAlertClass(alert.type)"
            :id="`alert_elem_${index}`"
            role="alert">
            {{alert.message}}
            <button type="button" class="close" @click="removeFromAlerts(index)">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</template>

<<script>
export default {
    data(){
        return{
            alerts: []
        }
    },
    mounted() {
        this.subscribeForAlerts();
        // this.timerToHideAlert();
    },
    methods: {
        subscribeForAlerts(){
            let instance = this;
            this.$hub.$on("showAnAlert", (msg,type="info") => {
                console.log("got alert", msg);
                instance.addToAlerts(msg,type);
            })
        },
        addToAlerts(msg,type){
            let tempAlert = {
                message: msg,
                type
            }

            this.alerts.push(tempAlert);
            console.log("alertAdded",this.alerts)
        },
        removeFromAlerts(id){
            let element = $(`#alert_elem_${id}`),
                instance = this;
            if(element.hasClass('zoomInRight')) element.removeClass('zoomInRight').addClass('zoomOutRight');
            // element.addClass('zoomOutRight');
            setTimeout(() => {
                instance.alerts.splice(id,1);
            }, 500);
            console.log("alertRemoved",id,this.alerts,element);
        },
        determineAlertClass(type){
            if(type == "success") return 'alert-success';
            if(type == "danger") return 'alert-danger';
            if(type == "info") return 'alert-info';
        }
    }
}
</script>