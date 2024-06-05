cd "$SOURCE_DIR" && zip -r "$DEST_DIR/$ARCHIVE_NAME" public

if [ $? -eq 0 ]; then
  echo "Archive created"
else
  echo "Error"
  exit 1
fi

exit 0