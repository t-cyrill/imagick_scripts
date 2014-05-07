#!/bin/bash

# メパチ作成スクリプト

# 2.59s
# 0.10s
# 2.59s
# 0.12s
# 0.12s
# 0.10s

convert -loop 0 -dispose previous \
    -delay 259 \
    reimu_01.png \
    -delay 10 \
    reimu_02.png \
    -delay 259 \
    reimu_01.png \
    -delay 12 \
    reimu_02.png \
    -delay 12 \
    reimu_01.png \
    -delay 10 \
    reimu_02.png \
    reimu_dest.gif

