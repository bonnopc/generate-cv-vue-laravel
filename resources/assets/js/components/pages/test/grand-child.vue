<<template>
    <div class="container">
        <h1>This is Grand-Child</h1>
        <button class="btn btn-primary btn-large" @click="showMessage()">Click</button>
    </div>
</template>

<<script>
import eventHub from '../../../app.js';
export default {
    

    data(){
        return{

        }
    },
    mounted(){
        console.log('grand-child ready!')
        // console.log(this.$hub);
    },
    methods: {
        showMessage(){
            // eventHub.$emit('showMessage');
            this.$hub.$emit('showMessage');
            this.$hub.$emit('showChild');
            console.log('clicked from grand child!');
        }
    }
}
</script>