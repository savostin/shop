<div
  x-data="alertComponent()"
  x-on:alert.window="showAlert($event.detail.type, $event.detail.message)"
  x-init="$watch('openAlertBox', value => {
    if(value){
      setTimeout(function () {
        openAlertBox = false
      }, 2000)
    }
  })"
  class="relative"
>
<template x-if="openAlertBox">
    <div
      class="fixed bottom-0 right-0"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-300"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
    >
      <div class="p-10">
        <div class="flex items-center text-sm font-bold px-4 py-3 rounded shadow-md" :class="alertBackgroundColor" role="alert">
          <span x-html="alertMessage" class="flex"></span>
          <button type="button" class="flex" @click="openAlertBox = false">
            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 ml-4"><path d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>
        </div>
      </div>
    </div>
  </template>

<script>
window.alertComponent = function () {
  return {
    openAlertBox: false,
    alertBackgroundColor: '',
    alertMessage: '',
    showAlert(type, alertMessage) {
      switch (type) {
        case 'success':
          this.alertBackgroundColor = 'bg-green-500'
          this.alertMessage = `${this.successIcon} ${alertMessage}`
          break
        case 'info':
          this.alertBackgroundColor = 'bg-blue-500'
          this.alertMessage = `${this.infoIcon} ${alertMessage}`
          break
        case 'warning':
          this.alertBackgroundColor = 'bg-yellow-500'
          this.alertMessage = `${this.warningIcon} ${alertMessage}`
          break
        case 'danger':
          this.alertBackgroundColor = 'bg-red-500'
          this.alertMessage = `${this.dangerIcon} ${alertMessage}`
          break
      }
      this.openAlertBox = true
    },
    successIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    infoIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    warningIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
    dangerIcon: `<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2 text-white"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>`,
  }
}
</script>

</div>