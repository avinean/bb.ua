export default {
    methods: {
        async request(j) {
            let params;
            if (j['method'] === 'get') {
                params = {params: j}
				return await this.axios('/api/request', params)
            }
            if (j['method'] === 'post') {
				params = new URLSearchParams()
				for (let key in j) {
					params.append(key, j[key])
				}
				return await this.axios.post('/api/request', params)
            }
        },
        async admin(j) {
			let params = new URLSearchParams()
			for (let key in j) {
				if (key === 'opts') {
					params.append(key, JSON.stringify(j[key]))
				}
				else {
					params.append(key, j[key])
				}
			}
			return await this.axios.post('/secure/admin', params)
        }
    }
}