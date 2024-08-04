# Self-Hosted Server on Firebat V8

This repository contains the configuration and necessary files to set up and maintain a self-hosted server using a Firebat V8 with the following specifications:

- **Processor**: Intel N100
- **Memory**: 16GB DDR5
- **Storage**: 2 disks in RAID 1, 512GB each

## Services

The server provides the following services using Docker Compose:

- **Cameras**: Security camera management and monitoring.
- **Collabora**: Online productivity suite.
- **Jackett**: Search proxy for PVR applications.
- **Jellyfin**: Media server.
- **Lidarr**: Music manager.
- **MariaDB**: SQL database.
- **Minecraft**: Minecraft game server.
- **Netdata**: Real-time monitoring and analytics of the server.
- **Nextcloud**: Collaboration and cloud storage platform.
- **Pi-hole**: Network-wide ad blocker.

## Configuration

### Prerequisites

- **Operating System**: Linux (recommended Ubuntu/Debian)
- **Docker** and **Docker Compose** installed
- Domain configured: `vaelico.es`

### Installation

1. **Clone the repository**:
    ```sh
    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    ```

2. **Run the setup script**:
    ```sh
    chmod +x setup.sh
    scripts/setup.sh
    ```
