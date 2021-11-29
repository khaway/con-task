import { getToken } from 'src/utils/cookies';
import { getPasswordResetEmail } from 'src/utils/storage';

// eslint-disable-next-line func-names
export default function () {
    return {
        token: getToken() || '',
        passwordUpdateEmail: getPasswordResetEmail() || '',
    };
}
