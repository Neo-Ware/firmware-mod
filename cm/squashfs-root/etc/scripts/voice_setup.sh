export DSP_IMAGE='/lib/dspimage.ld'
export VOICE_CHANNELS=2
export DATA_CHANNELS=0
export NUM_CHAN_DSP=2
export PRELOAD_DSP=1
export VOICE_EURO_SUPPORT=`nvread 2.0.1 long`
export MAS_SLIC_PSM_MODE_SUPPORT=`nvread 2.6.10 long`
export MAS_DECT_SUPPORT=`nvread 2.6.11 long`
export MAS_VLM_SUPPORT=`nvread 2.6.12 long`
export MAS_SLIC_WB_MODE_SUPPORT=`nvread 2.6.14 long`
export MAS_PP_SUPPORT=`nvread 2.6.16 long`
if [ "$MAS_PP_SUPPORT" == "" ];
then
    export MAS_PP_SUPPORT=1
    echo "VoPP NVRAM flag setting NOT exist, setting default value to 1, MAS_PP_SUPPORT=$MAS_PP_SUPPORT (enable/on) "
else
    echo "VoPP NVRAM flag setting exist, MAS_PP_SUPPORT=$MAS_PP_SUPPORT (0-disable/off 1-enable/on)"
fi
echo "ARRIS disabled MAS_PP_SUPPORT"
export MAS_PP_SUPPORT=0
export TELE_ID=`nvread 2.0.13 str`
export MAC_ADDRESS=`nvread 2.0.9 str`
export NUM_TIDS=`nvread 2.0.15 long`
export MAS_DECT_RTC_CTS_SUPPORT=`nvread 2.6.17 long`