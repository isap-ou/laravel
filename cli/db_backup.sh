mysqldump  -u"$DB_USER" -p"$DB_PASSWORD" -h"$DB_HOST" "$DB_NAME" action_events \
                                                                 media \
                                                                 model_has_permissions \
                                                                 model_has_roles \
                                                                 mvm_products \
                                                                 nova_field_attachments \
                                                                 nova_notifications \
                                                                 nova_pending_field_attachments \
                                                                 nova_settings \
                                                                 permissions \
                                                                 posts \
                                                                 role_has_permissions \
                                                                 roles | gzip -c > "$PATH"