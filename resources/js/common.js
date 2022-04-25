export default{
    data(){
		return{

		}
	},
    methods: {
        async callApi(method, url, dataobject){
            try{
              return await axios({
                 method: method,
                 url: url,
                 data: {_token: document.querySelector("meta[name='csrf-token']").getAttribute("content"), ...dataobject}
               });
            }catch(e){
              return e.response
            }
		},
    }
}