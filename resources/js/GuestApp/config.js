const APP_VERSION = process.env.MIX_APP_VERSION || 'v1.0.0';
const APP_NAME = process.env.MIX_APP_NAME + "_admin_app"

export default {
	app_name : APP_NAME,
	storage_key:`${APP_NAME}_${APP_VERSION}_ADMIN`,
}
