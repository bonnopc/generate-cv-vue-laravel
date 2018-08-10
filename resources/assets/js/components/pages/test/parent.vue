<<template>
  <div>
      <h1>This is Parent</h1>
      <p>{{message}}</p>
      <test-child-component v-if="!seen"></test-child-component>
      <div v-if="seen">
          <h1>Seen True</h1>
      </div>
      <div v-else>
          <h1>Seen False</h1>
      </div>
  </div>
</template>

<<script>
export default {
    data(){
        return{
            message: '',
            seen: false
        }
    },
    mounted(){
        let instance = this;
        // eventHub.$on('callMessage', this.showMessage());
        // this.$hub.$on('showMessage', function () {
        //     instance.message = "another message!"
        //     console.log('another')
        // });
        // this.$hub.$on('showMessage', this.showMessage());

        console.log('parent ready')
        // this.showMessage();
    },
    methods: {
        showMessage(){
            // this.message = "got message";
            let instance= this;
            this.$hub.$on('showMessage', function () {
                instance.message = "another message!";
                instance.seen = !instance.seen;
                console.log('another')
            });
        }
    }
}
</script>

