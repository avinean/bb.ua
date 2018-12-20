export default {
    methods: {
    	showInfoMessage(text, time = 3000, delay = 0, withSuccess ) {
    		setTimeout(() => {
				if (withSuccess) {
					this.$router.push('#success');
				}
				this.$parent.showMessage = text;
				setTimeout(e => this.$parent.showMessage = null, time)
			}, delay);
		},
		getClearText(val, length = 300) {
			this.$parent.$refs.clear.innerHTML = val;
			return this.$parent.$refs.clear.textContent.slice(0, length);
		},
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
		async upload(e) {
			let file = e.target.files[0];
			let form = new FormData;
			form.append('file', file);
			let res = await this.axios.post(
				'/secure/uploadFile',
				form,
				{headers: {'Content-Type': 'multipart/form-data'}}
			);
			return res.data;
		},
		isValidEmail(email) {
			return /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(email);
		},
		isValidPhone(phone) {
			return /^((8|\+38|38)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10,10}$/.test(phone);
		},
		writeVisitStat(val) {
			this.request({
				method: 'get',
				className: 'Stat',
				methodName: 'writeVisitStat',
				opts: {
					fullPath: val.fullPath,
					path: val.path,
					page: val.path.split('/')[1],
					category: val.params.category || 'none',
					id: val.params.id || 'none',
				}
			});
		},
		writeContactStat(opts) {
			this.request({
				method: 'get',
				className: 'Stat',
				methodName: 'writeContactStat',
				opts
			});
		},
		getBanner(name) {
			return bannersMap[name];
		}
    }
}