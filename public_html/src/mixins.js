export default {
    data() {
        return {
            showMessage: null
        }
    },
    methods: {
        async request(j) {
            let params;
            if (j['method'] === 'get') {
                params = {params: j}
            }
            if (j['method'] === 'post') {
                params = j
            }
            return await this.axios('/api/request', params)
        }
    }
}