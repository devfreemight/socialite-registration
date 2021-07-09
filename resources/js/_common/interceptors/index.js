import Intercept401 from './on401';
import Intercept422 from './on422';
import Intercept200 from './on200';
import Intercept404 from './on404';

export default {
    onSuccess: [
        Intercept200,
    ],
    onError : [
        Intercept401,
        Intercept422,
        Intercept404,
    ]
}