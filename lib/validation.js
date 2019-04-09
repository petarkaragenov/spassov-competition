const validate = {
	email: (value, callback) => {
		const regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/igm;
		if (value.trim().length === 0) {
			callback('This field is required');
			return false;
		} else if (!regex.test(value.trim())) {
			callback('Invalid email address');
			return false;
		} 
		return true;
	},
	phone: (value, callback) => {
		const regex = /^\+|(00)+.[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/ig;
		if (value.trim().length === 0) {
			callback('This field is required');
			return false;
		} else if (!regex.test(value.trim())) {
			callback('Invalid phone number');
			return false;
		} 
		return true;
	},
	name: (value, callback) => {
		const regex = /^[A-Za-z]+/ig;
		if (value.trim().length === 0) {
			callback('This field is required');
			return false;
		} else if (!regex.test(value.trim())) {
			callback('Name must contain only letters');
			return false;
		} 
		return true;
	},
	fullName: (value, callback) => {
		const regex = /^[A-Za-z]+\s[A-Za-z]+/ig;
		if (value.trim().length === 0) {
			callback('This field is required');
			return false;
		} else if (!regex.test(value.trim())) {
			callback('Value must be a full name');
			return false;
		} 
		return true;
	},
	address: (value, callback) => {
		const regex = /^\d+\s[A-z]+[\s]?[A-z]+/ig;
		if (value.trim().length === 0) {
			callback('This field is required');
			return false;
		} else if (!regex.test(value.trim())) {
			callback('Invalid Address');
			return false;
		} 
		return true;
	},
	date: (value, callback) => {
		const regex = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/g;
		if (value.trim().length === 0) {
			callback('This field is required');
			return false;
		} else if (!regex.test(value.trim())) {
			callback('Invalid Date');
			return false;
		} 
		return true;
	},
	file: (value, { fileSize, extensions, isRequired = false }, callback) => {
		if (isRequired && !value.files[0]) {
				callback('This Field is required')
				return false;
		} else if ((isRequired && value.files[0]) || (!isRequired && value.files[0])) {
			if (fileSize !== undefined && value.size > fileSize) {
				callback(`File Size must not exceed ${fileSize/1048576}MB`);
				return false;
			} else if (extensions !== undefined) {
                let fileExtension = value.files[0].name.split(".")[1];
                if (extensions.indexOf(fileExtension) === -1) {
                    callback(`File does not match the required format(s)`);
				    return false;
                }
            }		
		}  else if (!isRequired && !value.files[0]) {
			return true;
		}
		return true;
	},
	custom: (value, { min, max, length, regex, isRequired, hasValues, isNumber }, callback, message) => {
		let err;
		if (min !== undefined) {
			if (value.trim().length < min) {
				err = `Value must be at least ${min} characters long`;
			}
		} 

		if (max !== undefined) {
			if (value.trim().length > max) {
				err = `Value must not exceed ${max} characters`;
			}
		} 

		if (length !== undefined) {
			if (value.trim().length > max) {
				err = message;
			}
		} 

		if (regex !== undefined) {
			if (!regex.test(value.trim())) {
				err = message;
			}

		}  

		if (isNumber !== undefined) {
			if (isNaN(parseInt(value.trim()))) {
				err = 'Value must be a number';
			}
		}

		 if (hasValues !== undefined) {
			if (hasValues.indexOf(value.trim()) === -1) {
				err = 'Invalid value';
			}
		}

		if (isRequired !== undefined) {
			if (isRequired && value.trim().length === 0) {
				err = 'This field is required';
			}
		}

		if (err !== undefined) {
			callback(err);
			return false;
		} else {
			return true;
		}
	}
}