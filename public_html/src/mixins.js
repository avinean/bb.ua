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
        async admin(methodName, opts) {
			let params = new URLSearchParams();
			params.append('opts', JSON.stringify(opts));
			params.append('methodName', methodName);
			return await this.axios.post('/secure/admin', params)
        },
		isValidEmail(email) {
			return /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(email);
		},
		isValidPhone(phone) {
			return /^[+]*\d*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/.test(phone);
		}
    }
}