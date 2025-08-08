<template>
  <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Settings</h1>
          <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your account and preferences</p>
        </div>
        <div class="flex items-center gap-2 px-3 py-1.5 bg-green-50 dark:bg-green-900/20 rounded-full">
          <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
          <span class="text-sm font-medium text-green-700 dark:text-green-300">Auto-saved</span>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <div class="mb-8">
      <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="flex space-x-8 overflow-x-auto scrollbar-hide">
          <button
            v-for="tab in tabs"
            :key="tab.id"
            @click="activeTab = tab.id"
            :class="[
              'flex items-center gap-2 py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-200',
              activeTab === tab.id
                ? 'border-blue-500 text-blue-600 dark:text-blue-400'
                : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:border-gray-300'
            ]"
          >
            <component :is="tab.icon" class="h-4 w-4" />
            {{ tab.name }}
          </button>
        </nav>
      </div>
    </div>

    <!-- Content -->
    <div class="space-y-8">
      <!-- Profile Tab -->
      <div v-if="activeTab === 'profile'" class="space-y-8">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/10 dark:to-indigo-900/10 rounded-2xl p-6 sm:p-8">
          <div class="flex flex-col sm:flex-row items-center gap-6">
            <div class="relative">
              <img
                :src="profile.avatar"
                :alt="profile.name"
                class="w-24 h-24 sm:w-32 sm:h-32 rounded-2xl object-cover ring-4 ring-white dark:ring-gray-800 shadow-lg"
              />
              <button
                @click="uploadAvatar"
                class="absolute -bottom-2 -right-2 p-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl"
              >
                <Camera class="h-4 w-4" />
              </button>
            </div>
            <div class="text-center sm:text-left">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ profile.name }}</h2>
              <p class="text-gray-600 dark:text-gray-400 mt-1">{{ profile.jobTitle }}</p>
              <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">{{ profile.company }}</p>
              <div class="flex items-center justify-center sm:justify-start gap-2 mt-3">
                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                <span class="text-sm text-gray-600 dark:text-gray-400">Online</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Profile Form -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
          <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-8">
              <div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Personal Information</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Update your personal details and contact information</p>
              </div>
              <button
                @click="editProfile = !editProfile"
                :class="[
                  'px-4 py-2 rounded-xl font-medium text-sm transition-all duration-200 flex items-center gap-2',
                  editProfile
                    ? 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
                    : 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-xl'
                ]"
              >
                <Edit class="h-4 w-4" />
                {{ editProfile ? 'Cancel' : 'Edit' }}
              </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                <input
                  v-model="profile.firstName"
                  :disabled="!editProfile"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:text-gray-500 transition-all duration-200"
                />
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                <input
                  v-model="profile.lastName"
                  :disabled="!editProfile"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:text-gray-500 transition-all duration-200"
                />
              </div>
              <div class="md:col-span-2 space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                <input
                  v-model="profile.email"
                  :disabled="!editProfile"
                  type="email"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:text-gray-500 transition-all duration-200"
                />
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                <input
                  v-model="profile.phone"
                  :disabled="!editProfile"
                  type="tel"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:text-gray-500 transition-all duration-200"
                />
              </div>
              <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Time Zone</label>
                <select
                  v-model="profile.timezone"
                  :disabled="!editProfile"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:text-gray-500 transition-all duration-200"
                >
                  <option value="UTC-8">Pacific Time (UTC-8)</option>
                  <option value="UTC-7">Mountain Time (UTC-7)</option>
                  <option value="UTC-6">Central Time (UTC-6)</option>
                  <option value="UTC-5">Eastern Time (UTC-5)</option>
                  <option value="UTC+0">UTC</option>
                </select>
              </div>
              <div class="md:col-span-2 space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
                <input
                  v-model="profile.company"
                  :disabled="!editProfile"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:text-gray-500 transition-all duration-200"
                />
              </div>
              <div class="md:col-span-2 space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                <textarea
                  v-model="profile.bio"
                  :disabled="!editProfile"
                  rows="4"
                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:text-gray-500 transition-all duration-200 resize-none"
                  placeholder="Tell us about yourself..."
                ></textarea>
              </div>
            </div>

            <div v-if="editProfile" class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
              <button
                @click="editProfile = false"
                class="px-6 py-3 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200 font-medium"
              >
                Cancel
              </button>
              <button
                @click="saveProfile"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all duration-200 flex items-center justify-center gap-2 font-medium shadow-lg hover:shadow-xl"
              >
                <Save class="h-4 w-4" />
                Save Changes
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Security Tab -->
      <div v-if="activeTab === 'security'" class="space-y-8">
        <!-- Password Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
          <div class="p-6 sm:p-8">
            <div class="mb-8">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Password & Authentication</h3>
              <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Manage your password and security settings</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
              <!-- Change Password -->
              <div class="space-y-6">
                <h4 class="font-medium text-gray-900 dark:text-white">Change Password</h4>
                <div class="space-y-4">
                  <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                    <input
                      v-model="passwordForm.current"
                      type="password"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                    />
                  </div>
                  <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                    <input
                      v-model="passwordForm.new"
                      type="password"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                    />
                  </div>
                  <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                    <input
                      v-model="passwordForm.confirm"
                      type="password"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                    />
                  </div>
                  <button
                    @click="changePassword"
                    class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all duration-200 flex items-center justify-center gap-2 font-medium shadow-lg hover:shadow-xl"
                  >
                    <Lock class="h-4 w-4" />
                    Update Password
                  </button>
                </div>
              </div>

              <!-- Two-Factor Authentication -->
              <div class="space-y-6">
                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="font-medium text-gray-900 dark:text-white">Two-Factor Authentication</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Add extra security to your account</p>
                  </div>
                  <div class="flex items-center gap-3">
                    <span :class="[
                      'px-3 py-1 rounded-full text-xs font-medium',
                      security.twoFactorEnabled 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300'
                        : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'
                    ]">
                      {{ security.twoFactorEnabled ? 'Enabled' : 'Disabled' }}
                    </span>
                    <button
                      @click="toggleTwoFactor"
                      :class="[
                        'relative w-12 h-6 rounded-full transition-all duration-200',
                        security.twoFactorEnabled ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600'
                      ]"
                    >
                      <div :class="[
                        'absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform duration-200 shadow-sm',
                        security.twoFactorEnabled ? 'translate-x-6' : 'translate-x-0'
                      ]"></div>
                    </button>
                  </div>
                </div>

                <div v-if="!security.twoFactorEnabled" class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6">
                  <div class="flex items-start gap-4">
                    <div class="p-2 bg-blue-100 dark:bg-blue-800/30 rounded-lg">
                      <Shield class="h-5 w-5 text-blue-600 dark:text-blue-400" />
                    </div>
                    <div>
                      <h5 class="font-medium text-blue-900 dark:text-blue-100 mb-2">Enhance Your Security</h5>
                      <p class="text-sm text-blue-800 dark:text-blue-200 mb-4">
                        Two-factor authentication adds an extra layer of security to your account by requiring a second form of verification.
                      </p>
                      <button
                        @click="setupTwoFactor"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-all duration-200 font-medium"
                      >
                        Set Up 2FA
                      </button>
                    </div>
                  </div>
                </div>

                <div v-else class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6">
                  <div class="flex items-start gap-4">
                    <div class="p-2 bg-green-100 dark:bg-green-800/30 rounded-lg">
                      <CheckCircle class="h-5 w-5 text-green-600 dark:text-green-400" />
                    </div>
                    <div>
                      <h5 class="font-medium text-green-900 dark:text-green-100 mb-2">2FA is Active</h5>
                      <p class="text-sm text-green-800 dark:text-green-200">
                        Your account is protected with two-factor authentication.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Active Sessions -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
          <div class="p-6 sm:p-8">
            <div class="mb-8">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Active Sessions</h3>
              <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Manage your active login sessions across devices</p>
            </div>
            
            <div class="space-y-4">
              <div
                v-for="session in security.activeSessions"
                :key="session.id"
                class="flex flex-col sm:flex-row sm:items-center justify-between p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl gap-4"
              >
                <div class="flex items-center gap-4">
                  <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                    <Monitor v-if="session.device === 'desktop'" class="h-5 w-5 text-blue-600 dark:text-blue-400" />
                    <Smartphone v-else class="h-5 w-5 text-blue-600 dark:text-blue-400" />
                  </div>
                  <div>
                    <div class="font-medium text-gray-900 dark:text-white">{{ session.device }} - {{ session.browser }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ session.location }} • {{ session.lastActive }}</div>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <span v-if="session.current" class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 text-sm rounded-full font-medium">
                    Current Session
                  </span>
                  <button
                    v-else
                    @click="revokeSession(session.id)"
                    class="px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-sm rounded-lg transition-all duration-200 font-medium"
                  >
                    Revoke
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Notifications Tab -->
      <div v-if="activeTab === 'notifications'">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
          <div class="p-6 sm:p-8">
            <div class="mb-8">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Notification Preferences</h3>
              <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Choose how you want to be notified about important events</p>
            </div>
            
            <div class="space-y-8">
              <div
                v-for="category in notificationCategories"
                :key="category.id"
                class="border-b border-gray-200 dark:border-gray-700 pb-8 last:border-b-0 last:pb-0"
              >
                <div class="flex items-center gap-3 mb-6">
                  <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <component :is="category.icon" class="h-5 w-5 text-blue-600 dark:text-blue-400" />
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900 dark:text-white">{{ category.name }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ category.description }}</p>
                  </div>
                </div>
                
                <div class="space-y-6">
                  <div
                    v-for="setting in category.settings"
                    :key="setting.id"
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl"
                  >
                    <div>
                      <div class="font-medium text-gray-900 dark:text-white">{{ setting.name }}</div>
                      <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ setting.description }}</div>
                    </div>
                    <div class="flex items-center gap-8">
                      <label class="flex items-center cursor-pointer">
                        <input
                          v-model="setting.email"
                          type="checkbox"
                          class="sr-only"
                        />
                        <div :class="[
                          'relative w-10 h-5 rounded-full transition-all duration-200',
                          setting.email ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600'
                        ]">
                          <div :class="[
                            'absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-transform duration-200 shadow-sm',
                            setting.email ? 'translate-x-5' : 'translate-x-0'
                          ]"></div>
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Email</span>
                      </label>
                      <label class="flex items-center cursor-pointer">
                        <input
                          v-model="setting.push"
                          type="checkbox"
                          class="sr-only"
                        />
                        <div :class="[
                          'relative w-10 h-5 rounded-full transition-all duration-200',
                          setting.push ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600'
                        ]">
                          <div :class="[
                            'absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-transform duration-200 shadow-sm',
                            setting.push ? 'translate-x-5' : 'translate-x-0'
                          ]"></div>
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Push</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
              <button
                @click="saveNotifications"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all duration-200 flex items-center gap-2 font-medium shadow-lg hover:shadow-xl"
              >
                <Save class="h-4 w-4" />
                Save Preferences
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Preferences Tab -->
      <div v-if="activeTab === 'preferences'">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
          <div class="p-6 sm:p-8">
            <div class="mb-8">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Application Preferences</h3>
              <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Customize your experience and interface settings</p>
            </div>
            
            <div class="space-y-8">
              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <div>
                  <div class="font-medium text-gray-900 dark:text-white">Theme</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Choose your preferred color scheme</div>
                </div>
                <select
                  v-model="preferences.theme"
                  class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 min-w-[140px]"
                >
                  <option value="light">Light</option>
                  <option value="dark">Dark</option>
                  <option value="system">System</option>
                </select>
              </div>

              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <div>
                  <div class="font-medium text-gray-900 dark:text-white">Language</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Select your preferred language</div>
                </div>
                <select
                  v-model="preferences.language"
                  class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200 min-w-[140px]"
                >
                  <option value="en">English</option>
                  <option value="es">Spanish</option>
                  <option value="fr">French</option>
                  <option value="de">German</option>
                </select>
              </div>

              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <div>
                  <div class="font-medium text-gray-900 dark:text-white">Auto-save</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Automatically save your work as you type</div>
                </div>
                <label class="flex items-center cursor-pointer">
                  <input
                    v-model="preferences.autoSave"
                    type="checkbox"
                    class="sr-only"
                  />
                  <div :class="[
                    'relative w-12 h-6 rounded-full transition-all duration-200',
                    preferences.autoSave ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600'
                  ]">
                    <div :class="[
                      'absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform duration-200 shadow-sm',
                      preferences.autoSave ? 'translate-x-6' : 'translate-x-0'
                    ]"></div>
                  </div>
                </label>
              </div>

              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <div>
                  <div class="font-medium text-gray-900 dark:text-white">Sound Effects</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Play sounds for notifications and interactions</div>
                </div>
                <label class="flex items-center cursor-pointer">
                  <input
                    v-model="preferences.soundEffects"
                    type="checkbox"
                    class="sr-only"
                  />
                  <div :class="[
                    'relative w-12 h-6 rounded-full transition-all duration-200',
                    preferences.soundEffects ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600'
                  ]">
                    <div :class="[
                      'absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform duration-200 shadow-sm',
                      preferences.soundEffects ? 'translate-x-6' : 'translate-x-0'
                    ]"></div>
                  </div>
                </label>
              </div>

              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <div>
                  <div class="font-medium text-gray-900 dark:text-white">Compact Mode</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Use a more compact interface layout</div>
                </div>
                <label class="flex items-center cursor-pointer">
                  <input
                    v-model="preferences.compactMode"
                    type="checkbox"
                    class="sr-only"
                  />
                  <div :class="[
                    'relative w-12 h-6 rounded-full transition-all duration-200',
                    preferences.compactMode ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600'
                  ]">
                    <div :class="[
                      'absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform duration-200 shadow-sm',
                      preferences.compactMode ? 'translate-x-6' : 'translate-x-0'
                    ]"></div>
                  </div>
                </label>
              </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
              <button
                @click="savePreferences"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all duration-200 flex items-center gap-2 font-medium shadow-lg hover:shadow-xl"
              >
                <Save class="h-4 w-4" />
                Save Preferences
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Toast Notification -->
    <div
      v-if="showToast"
      class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 z-50 animate-slide-up max-w-sm"
    >
      <div class="p-1 bg-green-500 rounded-full">
        <CheckCircle class="h-4 w-4" />
      </div>
      <span class="font-medium">{{ toastMessage }}</span>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import {
  User,
  Shield,
  Bell,
  Palette,
  Edit,
  Camera,
  Save,
  Lock,
  Monitor,
  Smartphone,
  Phone,
  Mail,
  CheckCircle,
} from 'lucide-vue-next'

import LayoutClient from '@/Layouts/LayoutClient.vue'
defineOptions({layout : LayoutClient})
// State
const activeTab = ref('profile')
const editProfile = ref(false)
const showToast = ref(false)
const toastMessage = ref('')

// Tabs
const tabs = ref([
  { id: 'profile', name: 'Profile', icon: User },
  { id: 'security', name: 'Security', icon: Shield },
  { id: 'notifications', name: 'Notifications', icon: Bell },
  { id: 'preferences', name: 'Preferences', icon: Palette },
])

// Profile data
const profile = reactive({
  firstName: 'John',
  lastName: 'Smith',
  email: 'john.smith@company.com',
  phone: '+1 (555) 123-4567',
  timezone: 'UTC-8',
  company: 'Acme Corporation',
  jobTitle: 'Product Manager',
  bio: 'Passionate about creating innovative solutions that drive business growth and enhance user experiences.',
  avatar: '/placeholder.svg?height=128&width=128&text=JS',
  name: 'John Smith'
})

// Password form
const passwordForm = reactive({
  current: '',
  new: '',
  confirm: ''
})

// Security settings
const security = reactive({
  twoFactorEnabled: false,
  activeSessions: [
    {
      id: 1,
      device: 'desktop',
      browser: 'Chrome 120',
      location: 'San Francisco, CA',
      lastActive: '2 minutes ago',
      current: true
    },
    {
      id: 2,
      device: 'mobile',
      browser: 'Safari Mobile',
      location: 'San Francisco, CA',
      lastActive: '1 hour ago',
      current: false
    },
    {
      id: 3,
      device: 'desktop',
      browser: 'Firefox 121',
      location: 'New York, NY',
      lastActive: '3 days ago',
      current: false
    }
  ]
})

// Notification categories
const notificationCategories = ref([
  {
    id: 'calls',
    name: 'Call Notifications',
    icon: Phone,
    description: 'Notifications about your AI-powered calls and campaigns',
    settings: [
      {
        id: 'call_started',
        name: 'Call Started',
        description: 'When a new call begins',
        email: true,
        push: true
      },
      {
        id: 'call_completed',
        name: 'Call Completed',
        description: 'When a call ends successfully',
        email: true,
        push: false
      },
      {
        id: 'call_failed',
        name: 'Call Failed',
        description: 'When a call encounters an error',
        email: true,
        push: true
      }
    ]
  },
  {
    id: 'account',
    name: 'Account Activity',
    icon: User,
    description: 'Important account and security updates',
    settings: [
      {
        id: 'login_new_device',
        name: 'New Device Login',
        description: 'When you log in from a new device',
        email: true,
        push: true
      },
      {
        id: 'password_changed',
        name: 'Password Changed',
        description: 'When your password is updated',
        email: true,
        push: false
      }
    ]
  },
  {
    id: 'marketing',
    name: 'Product Updates',
    icon: Mail,
    description: 'New features, updates, and announcements',
    settings: [
      {
        id: 'product_updates',
        name: 'Feature Updates',
        description: 'New features and improvements',
        email: true,
        push: false
      },
      {
        id: 'newsletters',
        name: 'Newsletter',
        description: 'Weekly tips and best practices',
        email: false,
        push: false
      }
    ]
  }
])

// Preferences
const preferences = reactive({
  theme: 'system',
  language: 'en',
  autoSave: true,
  soundEffects: false,
  compactMode: false
})

// Methods
const uploadAvatar = () => {
  showToastMessage('Avatar upload feature coming soon!')
}

const saveProfile = () => {
  editProfile.value = false
  showToastMessage('Profile updated successfully!')
}

const changePassword = () => {
  if (passwordForm.new !== passwordForm.confirm) {
    showToastMessage('Passwords do not match!')
    return
  }
  passwordForm.current = ''
  passwordForm.new = ''
  passwordForm.confirm = ''
  showToastMessage('Password updated successfully!')
}

const toggleTwoFactor = () => {
  security.twoFactorEnabled = !security.twoFactorEnabled
  showToastMessage(security.twoFactorEnabled ? '2FA enabled successfully!' : '2FA disabled!')
}

const setupTwoFactor = () => {
  showToastMessage('2FA setup wizard coming soon!')
}

const revokeSession = (sessionId) => {
  const index = security.activeSessions.findIndex(s => s.id === sessionId)
  if (index > -1) {
    security.activeSessions.splice(index, 1)
    showToastMessage('Session revoked successfully!')
  }
}

const saveNotifications = () => {
  showToastMessage('Notification preferences saved!')
}

const savePreferences = () => {
  showToastMessage('Preferences saved successfully!')
}

const showToastMessage = (message) => {
  toastMessage.value = message
  showToast.value = true
  setTimeout(() => {
    showToast.value = false
  }, 3000)
}
</script>

<style scoped>
@keyframes slide-up {
  from {
    transform: translateY(100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.animate-slide-up {
  animation: slide-up 0.3s ease-out;
}

.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

/* Custom scrollbar for main content */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: transparent;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 3px;
}

.dark ::-webkit-scrollbar-thumb {
  background: #475569;
}
</style>