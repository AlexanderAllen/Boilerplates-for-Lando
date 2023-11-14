# https://stackoverflow.com/q/70637123/467453
# Check if your Docker container has tty open.
# Needed in order to forward logs into /dev/stdin.

if tty -s
then
  echo "Terminal connected."
else
  echo "No Terminal connected."
fi

if [[ -p /dev/stdin ]] ; then
    echo "stdin is coming from a pipe"
fi
if [[ -t 0 ]] ; then
    echo "stdin is coming from the terminal"
fi
if [[ ! -t 0 && ! -p /dev/stdin ]] ; then
    echo "stdin is redirected"
fi

