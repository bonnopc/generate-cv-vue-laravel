<<template>
    <div class="container">
        <h1>This is Child</h1>
        <test-grand-child-component></test-grand-child-component>
    </div>
</template>

<<script>
export default {
    data(){
        return{

        }
    },
    mounted(){
        this.$hub.$on('showChild', function () {
            console.log('this is child calling')
        })
    },
    methods: {
        showChild(){
            console.log('this is from child method')
        }
    }
}
</script>