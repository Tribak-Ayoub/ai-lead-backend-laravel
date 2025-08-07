<script>
import { defineComponent } from 'vue'

export default defineComponent({
    setup() {
        
    },
})


import { ref, computed } from "vue"

export function UseCallLog() {
  const callLogs = ref([])
  const isLoading = ref(false)
  const filters = ref({
    dateRange: "today",
    status: "all",
    campaign: "all",
    search: "",
  })

  // Sample data for generating realistic call logs
  const sampleNames = [
    "Sarah Johnson",
    "Mike Chen",
    "Emily Davis",
    "Robert Wilson",
    "Lisa Anderson",
    "David Brown",
    "Jennifer Garcia",
    "Michael Rodriguez",
    "Ashley Martinez",
    "Christopher Lee",
    "Amanda Taylor",
    "Daniel Thomas",
    "Jessica Hernandez",
    "Matthew Moore",
    "Stephanie Jackson",
    "Andrew Martin",
    "Nicole Thompson",
    "Ryan White",
    "Samantha Lopez",
    "Kevin Gonzalez",
  ]

  const sampleCompanies = [
    "Tech Solutions Inc",
    "Global Marketing Co",
    "Innovative Systems",
    "Digital Dynamics",
    "Future Enterprises",
    "Smart Business Ltd",
    "Advanced Technologies",
    "Premier Services",
    "Elite Consulting",
    "Strategic Partners",
    "Modern Solutions",
    "Creative Agency",
    "Professional Services",
    "Dynamic Systems",
    "Excellence Corp",
  ]

  const callStatuses = [
    { status: "completed", weight: 60 },
    { status: "qualified", weight: 25 },
    { status: "not-qualified", weight: 10 },
    { status: "no-answer", weight: 15 },
    { status: "busy", weight: 8 },
    { status: "voicemail", weight: 12 },
    { status: "failed", weight: 5 },
  ]

  const campaigns = [
    "Summer Promotion 2024",
    "Q1 Lead Generation",
    "Product Launch Campaign",
    "Webinar Follow-up",
    "Cold Outreach",
    "Referral Program",
    "Holiday Special",
  ]

  const intents = [
    "interested",
    "not-interested",
    "callback-requested",
    "information-requested",
    "price-inquiry",
    "demo-requested",
    "competitor-mention",
    "budget-concern",
  ]

  // Generate random phone number
  const generatePhoneNumber = () => {
    const areaCode = Math.floor(Math.random() * 900) + 100
    const exchange = Math.floor(Math.random() * 900) + 100
    const number = Math.floor(Math.random() * 9000) + 1000
    return `+1 (${areaCode}) ${exchange}-${number}`
  }

  // Generate random duration in seconds
  const generateDuration = (status) => {
    if (status === "no-answer" || status === "busy") return Math.floor(Math.random() * 30) + 5
    if (status === "voicemail") return Math.floor(Math.random() * 60) + 30
    if (status === "failed") return Math.floor(Math.random() * 10) + 1
    return Math.floor(Math.random() * 300) + 60 // 1-5 minutes for completed calls
  }

  // Format duration to MM:SS
  const formatDuration = (seconds) => {
    const minutes = Math.floor(seconds / 60)
    const remainingSeconds = seconds % 60
    return `${minutes}:${remainingSeconds.toString().padStart(2, "0")}`
  }

  // Generate weighted random status
  const getRandomStatus = () => {
    const totalWeight = callStatuses.reduce((sum, item) => sum + item.weight, 0)
    let random = Math.random() * totalWeight

    for (const item of callStatuses) {
      random -= item.weight
      if (random <= 0) return item.status
    }
    return "completed"
  }

  // Generate random date within range
  const generateRandomDate = (daysBack = 30) => {
    const now = new Date()
    const pastDate = new Date(now.getTime() - daysBack * 24 * 60 * 60 * 1000)
    const randomTime = pastDate.getTime() + Math.random() * (now.getTime() - pastDate.getTime())
    return new Date(randomTime)
  }

  // Generate AI confidence score
  const generateConfidenceScore = (status) => {
    if (status === "qualified") return Math.floor(Math.random() * 20) + 80 // 80-100%
    if (status === "not-qualified") return Math.floor(Math.random() * 30) + 20 // 20-50%
    if (status === "completed") return Math.floor(Math.random() * 40) + 60 // 60-100%
    return Math.floor(Math.random() * 50) + 30 // 30-80% for others
  }

  // Generate single call log entry
  const generateCallLog = (id) => {
    const status = getRandomStatus()
    const duration = generateDuration(status)
    const date = generateRandomDate()
    const name = sampleNames[Math.floor(Math.random() * sampleNames.length)]
    const company = sampleCompanies[Math.floor(Math.random() * sampleCompanies.length)]
    const campaign = campaigns[Math.floor(Math.random() * campaigns.length)]
    const intent = intents[Math.floor(Math.random() * intents.length)]
    const confidenceScore = generateConfidenceScore(status)

    return {
      id,
      leadName: name,
      company,
      phoneNumber: generatePhoneNumber(),
      status,
      duration: formatDuration(duration),
      durationSeconds: duration,
      timestamp: date,
      campaign,
      intent: status === "completed" || status === "qualified" ? intent : null,
      confidenceScore,
      recordingUrl:
        status !== "no-answer" && status !== "busy" && status !== "failed" ? `/recordings/call_${id}.mp3` : null,
      transcriptUrl: status === "completed" || status === "qualified" ? `/transcripts/call_${id}.txt` : null,
      notes: generateCallNotes(status, intent),
      aiSummary: generateAISummary(status, intent, name, company),
    }
  }

  // Generate call notes based on status
  const generateCallNotes = (status, intent) => {
    const noteTemplates = {
      qualified: [
        "Lead showed strong interest in our services",
        "Requested follow-up meeting next week",
        "Budget confirmed, decision maker identified",
        "Expressed urgency in finding solution",
      ],
      "not-qualified": [
        "Not currently in market for our services",
        "Budget constraints mentioned",
        "Already working with competitor",
        "Not the decision maker",
      ],
      completed: [
        "Call completed successfully",
        "Information provided as requested",
        "Follow-up scheduled",
        "Additional questions answered",
      ],
      voicemail: ["Left detailed voicemail message", "Callback requested", "Information sent via email"],
    }

    const templates = noteTemplates[status] || ["Call completed"]
    return templates[Math.floor(Math.random() * templates.length)]
  }

  // Generate AI summary
  const generateAISummary = (status, intent, name, company) => {
    if (status === "qualified") {
      return `${name} from ${company} expressed strong interest. Key intent: ${intent}. Recommended for immediate follow-up.`
    }
    if (status === "not-qualified") {
      return `${name} from ${company} not currently qualified. Reason: ${intent}. Consider nurture campaign.`
    }
    if (status === "completed") {
      return `Successful conversation with ${name} from ${company}. Intent detected: ${intent}.`
    }
    return `Call with ${name} from ${company} - ${status}.`
  }

  // Generate multiple call logs
  const generateCallLogs = async (count = 50) => {
    isLoading.value = true

    // Simulate API delay
    await new Promise((resolve) => setTimeout(resolve, 1000))

    const logs = []
    for (let i = 1; i <= count; i++) {
      logs.push(generateCallLog(i))
    }

    // Sort by timestamp (newest first)
    logs.sort((a, b) => b.timestamp - a.timestamp)

    callLogs.value = logs
    isLoading.value = false

    return logs
  }

  // Filter call logs based on current filters
  const filteredCallLogs = computed(() => {
    let filtered = [...callLogs.value]

    // Date range filter
    if (filters.value.dateRange !== "all") {
      const now = new Date()
      let startDate

      switch (filters.value.dateRange) {
        case "today":
          startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate())
          break
        case "yesterday":
          startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 1)
          const endDate = new Date(now.getFullYear(), now.getMonth(), now.getDate())
          filtered = filtered.filter((log) => log.timestamp >= startDate && log.timestamp < endDate)
          break
        case "week":
          startDate = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000)
          break
        case "month":
          startDate = new Date(now.getTime() - 30 * 24 * 60 * 60 * 1000)
          break
      }

      if (filters.value.dateRange !== "yesterday") {
        filtered = filtered.filter((log) => log.timestamp >= startDate)
      }
    }

    // Status filter
    if (filters.value.status !== "all") {
      filtered = filtered.filter((log) => log.status === filters.value.status)
    }

    // Campaign filter
    if (filters.value.campaign !== "all") {
      filtered = filtered.filter((log) => log.campaign === filters.value.campaign)
    }

    // Search filter
    if (filters.value.search) {
      const searchTerm = filters.value.search.toLowerCase()
      filtered = filtered.filter(
        (log) =>
          log.leadName.toLowerCase().includes(searchTerm) ||
          log.company.toLowerCase().includes(searchTerm) ||
          log.phoneNumber.includes(searchTerm) ||
          log.campaign.toLowerCase().includes(searchTerm),
      )
    }

    return filtered
  })

  // Export call logs to CSV
  const exportToCSV = () => {
    const headers = [
      "ID",
      "Lead Name",
      "Company",
      "Phone Number",
      "Status",
      "Duration",
      "Date",
      "Time",
      "Campaign",
      "Intent",
      "Confidence Score",
      "Notes",
    ]

    const csvContent = [
      headers.join(","),
      ...filteredCallLogs.value.map((log) =>
        [
          log.id,
          `"${log.leadName}"`,
          `"${log.company}"`,
          log.phoneNumber,
          log.status,
          log.duration,
          log.timestamp.toLocaleDateString(),
          log.timestamp.toLocaleTimeString(),
          `"${log.campaign}"`,
          log.intent || "",
          log.confidenceScore,
          `"${log.notes}"`,
        ].join(","),
      ),
    ].join("\n")

    const blob = new Blob([csvContent], { type: "text/csv" })
    const url = window.URL.createObjectURL(blob)
    const link = document.createElement("a")
    link.href = url
    link.download = `call-logs-${new Date().toISOString().split("T")[0]}.csv`
    link.click()
    window.URL.revokeObjectURL(url)
  }

  // Get call statistics
  const callStats = computed(() => {
    const logs = filteredCallLogs.value
    const total = logs.length

    if (total === 0) {
      return {
        total: 0,
        qualified: 0,
        completed: 0,
        avgDuration: "0:00",
        conversionRate: 0,
      }
    }

    const qualified = logs.filter((log) => log.status === "qualified").length
    const completed = logs.filter((log) => log.status === "completed" || log.status === "qualified").length
    const totalSeconds = logs.reduce((sum, log) => sum + log.durationSeconds, 0)
    const avgDuration = formatDuration(Math.floor(totalSeconds / total))
    const conversionRate = total > 0 ? Math.round((qualified / total) * 100) : 0

    return {
      total,
      qualified,
      completed,
      avgDuration,
      conversionRate,
    }
  })

  return {
    callLogs,
    filteredCallLogs,
    isLoading,
    filters,
    callStats,
    generateCallLogs,
    exportToCSV,
    campaigns,
    formatDuration,
  }
}
</script>
